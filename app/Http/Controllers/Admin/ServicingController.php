<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Servicing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ServicingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Servicing::orderBy('id','DESC')->paginate(20);
        return view('Admin.servicing.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::get()->pluck('name','id')->toArray();
        return view('Admin.servicing.add', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=Auth::guard('madmin')->id();
        $input=$request->all();
        if($input['type']=3){
            $validated = $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'complain' => 'required',
                'solution' => 'required',
                'technician' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'status' => 'required',
            ]);
            $customer['name']=$input['name'];
            $customer['phone']=$input['phone'];
            $customer['address']=$input['address'];
            $customer['email']=0;
            $customer['password']=0;
            $customer['status']='Active';
            $client=Customer::create($customer);
            $data['customer_id']=$client->id;
        }else{
            $validated = $request->validate([
                'customer_id' => 'required',
                'complain' => 'required',
                'solution' => 'required',
                'technician' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'status' => 'required',
            ]);
            $data['customer_id']=$input['customer_id'];
        }
        $data['complain']=$input['complain'];
        $data['solution']=$input['solution'];
        $data['product_model']=$input['product_model'];
        $data['technician']=$input['technician'];
        $data['amount']=$input['amount'];
        $data['date']=$input['date'];
        $data['admin_id']=$id;
        $data['status']=$input['status'];
        Servicing::create($data);
        Session::flash('status','Your Servicing has been sucessfully add');
        return redirect()->route('madmin.servicing.index');
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
        $customers=Customer::get()->pluck('name','id')->toArray();
        $service=Servicing::findorFail($id);
        return view('Admin.servicing.edit',compact('service', 'customers'));
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
        $service=Servicing::findorFail($id);
        $id=Auth::guard('madmin')->id();
        $input=$request->all();
        $data['customer_id']=$input['customer_id'];
        $data['complain']=$input['complain'];
        $data['solution']=$input['solution'];
        $data['product_model']=$input['product_model'];
        $data['technician']=$input['technician'];
        $data['amount']=$input['amount'];
        $data['date']=$input['date'];
        $data['admin_id']=$id;
        $data['status']=$input['status'];
        $service->update($data);
        Session::flash('status','Your Servicing has been sucessfully add');
        return redirect()->route('madmin.servicing.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service=Servicing::findorFail($id);
        $service->delete();
        Session::flash('status','Your Servicing has been sucessfully add');
        return redirect()->route('madmin.servicing.index');
    }
}
