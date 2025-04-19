<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Customer;
use App\Models\OrderPayment;
use DB;
use App\Models\Order;
use App\Models\OrderDetails;
use Auth;
use Cart;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Session;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        //dd($request->name);
        $customer = Auth::guard('mypanel')->user()->id;
        $city=City::where('id',$request->city)->first();
        $area=Area::where('id',$request->area)->first();
        $shipping['customer_id']=$customer;
        $shipping['name']=$request->name;
        $shipping['phone']=$request->phone;
        $shipping['city_id']=$request->city;
        $shipping['area_id']=$request->area;
        $shipping['city']=$city->name;
        $shipping['area']=$area->name;
        $shipping['address']=$request->address;
        $shipping_address = json_encode($shipping);
//dd($shipping_address);
        //$billing_id = json_encode($request->all());

//        dd(Cart::session($customer)->getContent());
//        if (Auth::guard('mypanel')->user()) {
//            $userID = Auth::guard('mypanel')->user()->id;
//            $items = Cart::session($userID)->getContent();
//        }
//dd($request->all());
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
        //$order['shipping_id'] = "shipping_id";
        //$order['billing_id'] = $billing_id;
        if ($request->payment_method == 'cash_on_delivery') {
            $order['payment_type'] = "COD";
        }elseif($request->payment_method == 'ssl'){
            $order['payment_type'] = "SSLCommerz";
        }
        //$order['payment_details'] = "details";
        $order['payment_status'] = "Pending";
        $order['cupon_id'] = "cupon_id";
        $order['cupon_amount'] = "cupon_amount";
        $order['status'] = "Pending";

        //order details table
        //dd($items[2]->attributes);
        $cartCollection = Cart::getContent();
        foreach ($cartCollection as $key => $value) {
            $order_details['invoice_no'] = $order['invoice_no'];
            $order_details['product_id'] = $key;
            $order_details['name'] = $value->name;
            $order_details['sized'] = $value->attributes->sized;
            $order_details['colored'] = $value->attributes->colored;
            $order_details['qty'] = $value->quantity;
            $order_details['price'] = $value->price;
            $order_details['total'] = $value->price * $value->quantity;
            OrderDetails::create($order_details);
         } 


        Order::create($order);

        if ($request->payment_method == 'cash_on_delivery') {
            Cart::clear();
            return redirect()->route('mypanel.morder.index')->with('status','Order has is Successful! placed!');
        }elseif ($request->payment_method == 'wallet') {
            //$user = \Illuminate\Support\Facades\Auth::user();
            $user->balance -= Order::findOrFail($request->session()->get('order_id'))->grand_total;
            $user->save();
            return $this->checkout_done($request->session()->get('order_id'), null);
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
//
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



    public function success(Request $request)
    {
        $payment_data = json_encode($request->all());
        $paymentBl=json_decode($payment_data);
        $invoice_no = $request->tran_id;
        $first_step = Order::where("invoice_no", $invoice_no)->first();
        //dd($paymentBl->amount);
        //$payment_status = array();
        $payment_status['payment_status'] = "Done";
        $first_step->update($payment_status);

        $check_status = Order::where("invoice_no", $invoice_no)->first();
        if ($check_status->payment_status == "Done") {
            //Payment
            $paymentt['order_id'] = $first_step->id;
            $paymentt['payment_id'] = 4;
            $paymentt['transaction_id'] =  $invoice_no;
            $paymentt['full_info'] =  $payment_data;
            $paymentt['amount'] =  $paymentBl->amount;
            $pay=OrderPayment::create($paymentt);

            Cart::clear();
            //echo "Transaction is Successful";
            return Redirect()->route('mypanel.morder.index')->with('status','Order has is Successful! placed!');
        }else{
            return Redirect()->route('checkout')->with('error','Order has is Successful! placed!');
        }
        

/*        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            } else {
                
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }*/


    }

    public function fail(Request $request)
    {

        //$request->session()->forget('order_id');
        //$request->session()->forget('payment_data');
        //flash(translate('Payment Failed'))->success();
//        $invoice_no = $request->tran_id;
//        $order = Order::where("invoice_no", $invoice_no)->first();
//        dd($invoice_no);
//        $orders = OrderDetails::where("invoice_no", $invoice_no)->get();
//        $order->each->delete();
//        $orders->each->delete();
        Session::flash('error','Payment Failed!');
        return redirect()->back();
//        $tran_id = $request->input('tran_id');
//
//        $order_detials = Order::where('invoice_no', $tran_id)->first();
//
//        if ($order_detials->status == 'Pending') {
//            $update_product = DB::table('orders')
//                ->where('transaction_id', $tran_id)
//                ->update(['status' => 'Failed']);
//            echo "Transaction is Falied";
//        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
//            echo "Transaction is already Successful";
//        } else {
//            echo "Transaction is Invalid";
//        }

    }

    public function cancel(Request $request)
    {
        //dd($request->input('tran_id'));
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('invoice_no', $tran_id)
            ->select('invoice_no', 'status', 'currency', 'total')->first();

        if ($request->status == 'CANCELLED') {
            $update_product = DB::table('orders')
                ->where('invoice_no', $tran_id)
                ->update(['status' => 'Canceled']);
            Session::flash('error','Payment Cancelled!');
            return redirect()->back();
//            $data="Cancelled";
//            return view('Mypanel.cancel', compact('data'));
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
           // echo "Transaction is already Successful";
            $data="Already Successful";
            return view('Mypanel.cancel', compact('data'));
        } else {
            //dd($request->all());
            Session::flash('error','Payment Cancelled!');
            return redirect()->back();
//            $data="Invalid";
//            return view('Mypanel.cancel', compact('data'));
            //echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
