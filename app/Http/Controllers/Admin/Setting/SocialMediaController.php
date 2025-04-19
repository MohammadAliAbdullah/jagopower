<?php

namespace App\Http\Controllers\Admin\Setting;


use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basics=SocialMedia::orderBy('id','ASC')->paginate(20);
        return view('Admin.socialmedia.index', compact('basics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companys=ContactInfo::get()->pluck('branch_name','id')->toArray();
        return view('Admin.socialmedia.add', compact('companys'));
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
        $udata['branch_id']=$data['basicinfo_id'];
        $udata['facebook']=$data['facebook'];
        $udata['twitter']=$data['twitter'];
        $udata['linkedin']=$data['linkedin'];
        $udata['instagram']=$data['instagram'];
        $udata['youtube']=$data['youtube'];
        $udata['tiktak']=$data['tiktak'];
        Socialmedia::create($udata);
        //dd($user_data);
        Session::flash('status','Social Media Info  has been sucessfully add');
        return redirect('/madmin/socialmedia');
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
        $companys=ContactInfo::get()->pluck('branch_name','id')->toArray();
        $show=Socialmedia::findOrFail($id);
        return view('Admin.socialmedia.edit', compact('companys', 'show'));
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
        $show=Socialmedia::findOrFail($id);
        $data=$request->all();
        $udata['branch_id']=$data['branch_id'];
        $udata['facebook']=$data['facebook'];
        $udata['twitter']=$data['twitter'];
        $udata['linkedin']=$data['linkedin'];
        $udata['instagram']=$data['instagram'];
        $udata['youtube']=$data['youtube'];
        $udata['tiktak']=$data['tiktak'];
        $show->update($udata);
        //dd($user_data);
        Session::flash('status','Social Media Info  has been sucessfully Updated!!');
        return redirect('/madmin/socialmedia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show=Socialmedia::findOrFail($id);
        $show->delete();
        Session::flash('status','Social Media  Info  has been sucessfully Deleted!!');
        return redirect('/madmin/socialmedia');
    }
}
