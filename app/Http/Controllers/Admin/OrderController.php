<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::orderBy('id','DESC')->paginate(10);
        return view('Admin.Orders.index', compact('orders'));
    }

    public function pending(){
        $orders=Order::where('status','Pending')->orderBy('id','DESC')->paginate(10);
        return view('Admin.Orders.pending', compact('orders'));
    }

    public function complete(){
        $orders=Order::where('status','Completed')->orderBy('id','DESC')->paginate(10);
        return view('Admin.Orders.complete', compact('orders'));
    }

    public function due(){
        $orders=Order::orderBy('id','DESC')->paginate(10);
        return view('Admin.Orders.due', compact('orders'));
    }

    public function paid(){
        $orders=Order::orderBy('id','DESC')->paginate(10);
        return view('Admin.Orders.paid', compact('orders'));
    }

    public function show($id)
    {
        $order=Order::findOrFail($id);
        return view('Admin.Orders.show', compact('order'));
    }

    public function invoicea4($invoice_no)
    {
        $data = [
            'invoice_no' => $invoice_no
        ];
        $pdf = PDF::loadView('Admin.Orders.printa4', $data);
        return $pdf->stream('invoiceA4-'.$invoice_no.'.pdf');
    }

    public function chalan($invoice_no)
    {
        $data = [
            'invoice_no' => $invoice_no
        ];
        $pdf = PDF::loadView('Admin.Orders.chalan', $data);
        return $pdf->stream('chalan-'.$invoice_no.'.pdf');
    }
    public function invoicea4photo($invoice_no)
    {
        $data = [
            'invoice_no' => $invoice_no
        ];
        $pdf = PDF::loadView('Admin.Orders.printa4photo', $data);
        return $pdf->stream('invoiceA4photo-'.$invoice_no.'.pdf');
    }
    public function store(Request $request)
    {
        $id=$request->id;
        $order=Order::where('id',$id)->first();
        $data['status']=$request->status;
        $order->update($data);
        Session::flash('status','Order has been sucessfully Update');
        return redirect()->back();

    }
}
