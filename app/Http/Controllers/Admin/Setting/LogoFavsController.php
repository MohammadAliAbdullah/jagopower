<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;


class LogoFavsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logofavs = ContactInfo::all();
        return view("Admin.LogoFavs.index", compact("logofavs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.LogoFavs.add");
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
        if($file=$request->file('logo')){
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

        ContactInfo::create($data);
        Session::flash('status','Your item has been sucessfully add');
        return redirect()->route('madmin.logofavs.index');
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
        $logofavs = ContactInfo::findOrFail($id);
        return view("Admin.LogoFavs.edit", compact('logofavs'));
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
        $logofavs = ContactInfo::findOrFail($id);
        if($file=$request->file('logo')){
            $img=preg_replace('/\s+/', '-','logo.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/');
            $img = Image::make($file->path());
            $img->resize(300, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $user_data['logo']=$names;
        }
        if($file1=$request->file('favicon')){
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
        $logofavs->update($user_data);
        Session::flash('status','Your Logo has been sucessfully update');
        return redirect()->route('madmin.logofavs.index');
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
