<?php

namespace App\Http\Controllers\Admin\SMS;

use App\Http\Controllers\Controller;
use App\SmsContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SMSTempleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values=SmsContent::orderBy('id','DESC')->paginate();
        return view('admin.smstemplete.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.smstemplete.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $udata['subject']=$data['subject'];
        $udata['content']=$data['content'];
        $udata['admin_id']=Auth::guard('admin')->user()->id;
        $udata['status']=$data['status'];
        SmsContent::create($udata);
        Session::flash('status','SMS Temeplete has been sucessfully add');
        return redirect('/admin/smstemplete');
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
        $value=SmsContent::findOrFail($id);
        return view('admin.smstemplete.edit', compact('value'));
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
        $value=SmsContent::findOrFail($id);
        $data=$request->all();
        $udata['subject']=$data['subject'];
        $udata['content']=$data['content'];
        $udata['admin_id']=Auth::guard('admin')->user()->id;
        $udata['status']=$data['status'];
        $value->update($udata);
        Session::flash('status','SMS Temeplete has been sucessfully Update!!');
        return redirect('/admin/smstemplete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value=SmsContent::findOrFail($id);
        $value->delete();
        Session::flash('status','SMS Temeplete has been sucessfully Delete!!');
        return redirect('/admin/smstemplete');
    }
}
