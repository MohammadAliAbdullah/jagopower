<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::orderBy('id','DESC')->paginate();
        return view('Admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.customer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $inseet['name'] = $data['name'];
        $inseet['phone']=$data['phone'];
        $inseet['email'] = $data['email'];
        $inseet['address'] = $data['address'];
        $inseet['password'] = Hash::make($data['password']);
        $inseet['status'] = "Pending";
//dd($category);
        Customer::create($inseet);
        Session::flash('status','Your Customer has been sucessfully added!');
        return redirect()->route('madmin.customeradmin.index');
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
        $customer=Customer::findOrFail($id);
        return view('Admin.customer.edit', compact('customer'));
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
        $customer=Customer::findOrFail($id);
        $inseet['name'] = $data['name'];
        $inseet['phone']=$data['phone'];
        $inseet['email'] = $data['email'];
        $inseet['address'] = $data['address'];
        $inseet['password'] = Hash::make($data['password']);
        $inseet['status'] = "Pending";
//dd($category);
        $customer->update($inseet);
        Session::flash('status','Your Customer has been sucessfully Updated!');
        return redirect()->route('madmin.customeradmin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer=Customer::findOrFail($id);
        $customer->delete();
        Session::flash('status','Your Customer has been sucessfully Delete!');
        return redirect()->route('madmin.customeradmin.index');
    }
}
