<?php

namespace App\Http\Controllers\Mypanel;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Area;
use App\Models\City;
use App\Models\Customer;
use App\Models\Division;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderDetails;
use App\Models\OrderPayment;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('mypanel')->user()->id;
        $orders=Order::orderBy('id','DESC')->where('customer_id',$user)->paginate(10);
        //dd($orders);
        return view('Mypanel.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $customer = Auth::guard('mypanel')->user()->id;
        $city=Division::where('id',$request->city)->first();
        $area=City::where('id',$request->area)->first();
        //Shipping Address
        $shipping['customer_id']=$customer;
        $shipping['name']=$request->name;
        $shipping['phone']=$request->phone;
        $shipping['city_id']=$request->city;
        $shipping['area_id']=$request->area;
        $shipping['city']=$city->name;
        $shipping['area']=$area->name;
        $shipping['address']=$request->address;
        $shipping_address = json_encode($shipping);

        //Order
        $order = array();
        $order['currency'] = "BDT";
        $order['invoice_no'] = "IN".time();
        $order['callan_no'] = "CL".time();
        $order['customer_id'] = $customer;
        $order['subtotal'] = Cart::getSubTotal();
        $order['discount'] = 0;
        $order['vat'] = 0;
        $order['delivary_charge'] = 0;
        $order['total'] = Cart::getTotal() - $order['discount'] + $order['delivary_charge'] + ($order['vat'] * $order['subtotal'] /100) ; # You cant not pay less than 10
        $order['shipping_address'] = $shipping_address;
        if ($request->payment_method == 'cash_on_delivery') {
            $order['payment_type'] = "COD";
            $order['payment_status'] = "Pending";
        }elseif($request->payment_method == 'Bkash'){
            $order['payment_type'] = "Bkash";
            $order['payment_status'] = "Pending";
        }elseif($request->payment_method == 'Rocket'){
            $order['payment_type'] = "Rocket";
            $order['payment_status'] = "Pending";
        }elseif($request->payment_method == 'ssl'){
            $order['payment_type'] = "SSLCommerz";
            $order['payment_status'] = "Pending";
        }
        //$order['payment_details'] = "details";
        $order['cupon_id'] = "cupon_id";
        $order['cupon_amount'] = "cupon_amount";
        $order['status'] = "Pending";
        $orderId=Order::create($order)->id;

        //Shipping Insert
        $shipping['order_id'] = $orderId;
        $shipping_id=OrderAddress::create($shipping);

        //order details table
        $cartCollection = Cart::getContent();
        foreach ($cartCollection as $key => $value) {
            $order_details['order_id'] = $orderId;
            $order_details['product_id'] = $key;
            $order_details['name'] = $value->name;
            //$order_details['sized'] = $value->attributes->sized;
            //$order_details['colored'] = $value->attributes->colored;
            $order_details['qty'] = $value->quantity;
            $order_details['price'] = $value->price;
            $order_details['total'] = $value->price * $value->quantity;
            OrderDetails::create($order_details);
        }

        //Payment Insert
        $paymentt['order_id']=$orderId;
        if ($request->payment_method == 'cash_on_delivery') {
            $paymentt['payment_id'] = 1;
            $paymentt['transaction_id'] = 'COD';
            $paymentt['full_info'] = 'cash_on_delivery';
            $paymentt['amount'] =  $order['total'];
            $pay=OrderPayment::create($paymentt);
        }elseif($request->payment_method == 'Bkash'){
            $paymentt['payment_id'] = 2;
            $paymentt['transaction_id'] = $request->transaction;
            $paymentt['full_info'] = $request->bkashnumber;
            $paymentt['amount'] =  $order['total'];
            $pay=OrderPayment::create($paymentt);
        }elseif($request->payment_method == 'Rocket'){
            $paymentt['payment_id'] = 3;
            $paymentt['transaction_id'] = $request->rocket_transaction;
            $paymentt['full_info'] = $request->rocket_number;
            $paymentt['amount'] =  $order['total'];
            $pay=OrderPayment::create($paymentt);
        }
        
        //dd($pay);
        if ($request->payment_method == 'cash_on_delivery') {
            Cart::clear();
            return redirect()->route('mypanel.morder.index')->with('status','Order has is Successful! placed!');
        }elseif ($request->payment_method == 'Nogod' OR $request->payment_method == 'Bkash') {
            Cart::clear();
            return redirect()->route('mypanel.morder.index')->with('status','Order has is Successful! placed!');
        }else{
            // default code is bellow.
            $customers=Customer::where('id',$customer)->first();
            $post_data = array();
            $post_data['total_amount'] = $order['total']; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = $order['invoice_no']; // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $customers->name;
            $post_data['cus_email'] = $customers->email;
            $post_data['cus_add1'] = $shipping['address'];
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $customers->phone;
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = $shipping['name'];
            $post_data['ship_add1'] = $shipping['address'];
            $post_data['ship_add2'] = "";
            $post_data['ship_city'] = $shipping['city'];
            $post_data['ship_state'] = $shipping['area'];
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = $shipping['phone'];
            $post_data['ship_country'] = "Bangladesh";
            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Electronics";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";


            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            //$payment_options = $sslc->makePayment($post_data, 'hosted');
            //$sslc = new SSLCommerz();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::where('invoice_no', $id)->first();
        $orders=OrderDetails::where('order_id', $order->id)->get();
        return view('Mypanel.order.show', compact('order','orders'));
    }

    public function invoice($id)
    {
//        $order=Order::where('invoice_no', $id)->first();
//        $orders=OrderDetails::where('invoice_no', $id)->get();
        $data = [
            'invoice_no' => $id
        ];
        //return view('Mypanel.order.invoice', compact('data'));
        $pdf = PDF::loadView('Mypanel.order.invoice', $data);
        return $pdf->stream('invoice-'.$id.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
