<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::paginate(10);
        return view("Admin.Banners.index", compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Banners.add");
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
        //Images
        if($file=$request->file('images')){
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $img1=preg_replace('/\s+/', '-', $time.'banner.'. $file->extension());
            $names1=$img1;
            $destinationPath = public_path('images/banners');
            $img1 = Image::make($file->path());
            $img1->resize(500, 570, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names1);
            $data['images']=$names1;
        }

        Banner::create($data);
        Session::flash('status','Your banner has been sucessfully add');
        return redirect()->route('madmin.banners.index');
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
        $banner = Banner::findOrFail($id);
        return view("Admin.Banners.edit", compact("banner"));
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
        $banner = Banner::findOrFail($id);

        if($file=$request->file('images')){
            if(file_exists(public_path() . "/images/banners/" . $banner->images)) {
                unlink(public_path() . "/images/banners/" . $banner->images);
            }
            $data["code"] = "";
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $img1=preg_replace('/\s+/', '-', $time.'banner.'. $file->extension());
            $names1=$img1;
            $destinationPath = public_path('images/banners');
            $img1 = Image::make($file->path());
            $img1->resize(500, 570, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names1);
            $data['images']=$names1;
        }

        if($request->code){
            $data['images']="";
            $data['code']=$request->code;
        }

        $banner->update($data);
        Session::flash('status','Your banner has been sucessfully updated');
        return redirect()->route('madmin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if(file_exists(public_path() . "/images/banners/" . $banner->images)) {
            unlink(public_path() . "/images/banners/" . $banner->images);
        }
        $banner->delete();
        Session::flash('status','Your banner has been sucessfully deleted');
        return redirect()->route('madmin.banners.index');
    }
}
