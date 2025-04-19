<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basics=ContactInfo::paginate(20);
        return view('Admin.contactinfo.index',compact('basics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.contactinfo.add');
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
        $udata['branch_name']=$data['branch_name'];
        $udata['hotline']=$data['hotline'];
        $udata['phone']=$data['phone'];
        $udata['email']=$data['email'];
        $udata['address']=$data['address'];
        $udata['whatsapp']=$data['whatsapp'];
        $udata['viber']=$data['viber'];
        $udata['wechat']=$data['wechat'];
        $udata['imo']=$data['imo'];
        //$udata['officetime']=$data['officetime'];
        $udata['googlemap']=$data['googlemap'];
        //dd($user_data);
        ContactInfo::create($udata);

        Session::flash('status','Your Contact Info has been sucessfully add');
        return redirect('/madmin/contactinfo');
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
        $show=ContactInfo::findOrFail($id);
        return view('Admin.contactinfo.edit',compact('show'));
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
        $data=$request->all();
        $oldData=ContactInfo::findOrFail($id);
        if($file=$request->file('logo')){
            if(file_exists(public_path() . "/images/" . $oldData->logo)) {
                unlink(public_path() . "/images/" . $oldData->logo);
            }
            $img=preg_replace('/\s+/', '-','logo.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/');
            $img = Image::make($file->path());
            $img->resize(200, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $user_data['logo']=$names;
        }

        if($file1=$request->file('favicon')){
            if(file_exists(public_path() . "/images/" . $oldData->favicon)) {
                unlink(public_path() . "/images/" . $oldData->favicon);
            }
            $img1=preg_replace('/\s+/', '-','favicon.'. $file1->extension());
            $names1=time().$img1;
            //$names=$img;
            $destinationPath1 = public_path('images/');
            $img1 = Image::make($file1->path());
            $img1->resize(50, 50, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath1 . '/' . $names1);
            $user_data['favicon']=$names1;
        }
        //Meta Info

        $udata['branch_name']=$data['branch_name'];
        $udata['hotline']=$data['hotline'];
        $udata['phone']=$data['phone'];
        $udata['email']=$data['email'];
        $udata['address']=$data['address'];
        $udata['whatsapp']=$data['whatsapp'];
        $udata['viber']=$data['viber'];
        $udata['wechat']=$data['wechat'];
        $udata['imo']=$data['imo'];
        //$udata['officetime']=$data['officetime'];
        $udata['googlemap']=$data['googlemap'];
        $oldData->update($udata);
        //dd($user_data);
        Session::flash('status','Your Contact Info has been sucessfully Updated!');
        return redirect('/madmin/contactinfo');
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
