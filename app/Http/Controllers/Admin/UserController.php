<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Madmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('madmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUser = Auth::guard('madmin')->user();
        $roleId = $loggedInUser->role_id;
        if ($roleId == 1) {
            $values = Madmin::all();
        }else{
            $values = Madmin::where('id', $loggedInUser->id)->get();
        }
        // dd(Auth::guard('madmin')->user()->role_id);
        return view('Admin.User.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.User.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $data['name'] = $input['name'];
        $data['email'] = $input['email'];
        $data['password'] = Hash::make($input['password']);
        //$data['role_id']=$input['role_id'];
        $data['status'] = $input['status'];
        Madmin::create($data);
        Session::flash('status', 'Admin User has been sucessfully add');
        return redirect()->route('madmin.adminuser.index');
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
        $value = Madmin::findOrFail($id);
        return view('Admin.User.edit', compact('value'));
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
        $value = Madmin::findOrFail($id);
        $input = $request->all();
        $data['name'] = $input['name'];
        $data['email'] = $input['email'];
        $data['password'] = Hash::make($input['passwords']);
        //$data['role_id']=$input['role_id'];
        $data['status'] = $input['status'];
        $value->update($data);
        Session::flash('status', 'Admin User has been sucessfully Update!!');
        return redirect()->route('madmin.adminuser.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Madmin::findOrFail($id);
        $value->delete();
        Session::flash('status', 'Admin User has been sucessfully Delete!!');
        return redirect()->route('madmin.adminuser.index');
    }
}
