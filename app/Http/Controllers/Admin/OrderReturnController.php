<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search){
            $orders=Order::where('invoice_no', 'like', '%' .$request->search. '%')->orderBy('id','DESC')->paginate(10);
        }else{
            $orders=Order::orderBy('id','DESC')->paginate(10);
        }
        return view('Admin.Orders.return.index', compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::findOrFail($id);
        $client=Customer::where('id',$order->customer_id)->first();
        $values=OrderDetails::where('order_id',$order->id)->get();
        return view('admin.Orders.return.edit', compact('order','client','values'));
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
        $data = $request->all();
        $invoice=Order::findOrFail($id);

        $invoices=Order::orderBy('id','DESC')->first();
        // $orders['invoice_no'] = $invoices->invoice_no+1;
        // $orders['callan_no'] = $invoices->callan_no+1;
        $orders['company_id'] = $data['company_id'];
        $orders['invoice_type'] = $data['invoice_type'];
        $orders['invoice_date'] = $data['invoice_date'];
        $orders['due_date'] = $data['due_date'];
        //$orders['client_id'] = $data['client_id'];
        $orders['subtotal'] = $data['subtotal'];
        $orders['discount'] = $data['discount'];
        $orders['vat'] = $data['vat'];
        $orders['delivary_charge'] = $data['delivary_charge'];
        $orders['total'] = $data['total'];
        $orders['due'] = $data['total']-$invoices->paid;
        $orders['note'] = $data['note'];
        $orders['hide'] = $data['hide'];
        $orders['edit_id'] = Auth::guard('admin')->user()->id;
        //$orders['type'] = 'Admin';
        $orders['status'] = $data['status'];
        //dd($orders)
        $invoice->update($orders);
        OrderDetails::where('invoice_no',$invoice->invoice_no)->delete();
        for ($i=0; $i < count($data['title']); $i++) {
            $service = OurService::where('title', $data['title'][$i])->first();
            if ($service!=NULL){
                $OrderDetails['service_id'] = $service->id ?? 0;
            }else{
                $OrderDetails['service_id'] = 0;
            }
            // Update product_stock
            $OrderDetails['invoice_no'] = $invoice->invoice_no;
            //$OrderDetails['service_id'] = $service->id;
            $OrderDetails['title'] = $data['title'][$i];
            //$OrderDetails['sized'] = !empty($data['sized'][$i]) ? $data['sized'][$i] : "";
            //$OrderDetails['colored'] = !empty($data['colored'][$i]) ? $data['colored'][$i] : "" ;
            $OrderDetails['qty'] = $data['qty'][$i];
            $OrderDetails['price'] = $data['price'][$i] ;
            $OrderDetails['total'] = $OrderDetails['qty']* $OrderDetails['price'];
            //dd($OrderDetails);
            OrderDetails::create($OrderDetails);
        }
        Session::flash('status','Your Invoice has been sucessfully add');
        return redirect()->route('order.index');
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
