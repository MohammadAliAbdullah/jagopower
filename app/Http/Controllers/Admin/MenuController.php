<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages=Menu::paginate(10);
        return view('Admin.menu.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus=Menu::where('parent_id',0)->get()->pluck('name','id')->toArray();
        return view('Admin.menu.add', compact('menus'));
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
        $udata['name']=$data['name'];
        $udata['url']=$data['url'];
        $udata['parent_id']=$data['parent_id'];
        $udata['icon']=$data['icon'];
        $udata['orders']=$data['orders'];
        $udata['status']=$data['status'];
        Menu::create($udata);
        //dd($user_data);
        Session::flash('status','Your Admin Menu has been sucessfully add');
        return redirect('/madmin/adminmenu');
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
        $menus=Menu::where('parent_id',0)->get()->pluck('name','id')->toArray();
        $edits=Menu::findOrFail($id);
        return view('Admin.menu.edit',compact('edits','menus'));
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

        $edits=Menu::findOrFail($id);
        $data=$request->all();
        $udata['name']=$data['name'];
        $udata['url']=$data['url'];
        $udata['parent_id']=$data['parent_id'];
        $udata['icon']=$data['icon'];
        $udata['orders']=$data['orders'];
        $udata['status']=$data['status'];
        $edits->update($udata);
        //dd($user_data);
        Session::flash('status','Your Admin Menu has been sucessfully Update!!');
        return redirect('/madmin/adminmenu');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $edits=Menu::findOrFail($id);
        $edits->delete();
        Session::flash('status','Your Admin Menu has been sucessfully Delete!!');
        return redirect('/madmin/adminmenu');
    }
}
