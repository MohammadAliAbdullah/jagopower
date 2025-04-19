<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Slide;
use Image;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::paginate(10);
        return view("Admin.Slides.index", compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Slides.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {
        $data = $request->all();
        //Image
//        $data['images'] = time() . '.'.$request->image->clientExtension();
//        $image_file = $request->image;
//        $image_dest = storage_path( 'admin/images/slides' );
//        $image_file->move( $image_dest, $data['images'] );
//        $data['url'] = asset('storage/admin/images/slides/'.$data['images']);
        if($file=$request->file('image')){
            $img=preg_replace('/\s+/', '-','slide.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/slide/');
            $img = Image::make($file->path());
            $img->resize(1500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $user_data['images']=$names;
        }
        $user_data['title']=$data['title'];
        $user_data['url']=$data['url'];
        $user_data['orders']=$data['orders'];
        $user_data['status']=$data['status'];
        //dd($user_data);
        Slide::create($user_data);
        Session::flash('status','Your slide has been sucessfully add');
        return redirect()->route('madmin.slides.index');
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
        $slide = Slide::findOrFail($id);
        return view("Admin.Slides.edit", compact("slide"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideRequest $request, $slide)
    {
        $data = $request->all();
        $slide = Slide::findOrFail($slide);

//        $data['url'] = "url";
//        if ($request->image) {
//            //Image
//            $data['images'] = time() . '.'.$request->image->clientExtension();
//            $image_file = $request->image;
//            $image_dest = storage_path( 'admin/images/slides' );
//            $image_file->move( $image_dest, $data['images'] );
//        }
        if($file=$request->file('image')){
            if(file_exists(public_path() . "/images/slide/" . $slide->images)) {
                unlink(public_path() . "/images/slide/" . $slide->images);
            }
            $img=preg_replace('/\s+/', '-','slide.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/slide/');
            $img = Image::make($file->path());
            $img->resize(1500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $user_data['images']=$names;
        }
        $user_data['title']=$data['title'];
        $user_data['url']=$data['url'];
        $user_data['orders']=$data['orders'];
        $user_data['status']=$data['status'];

        $slide->update($user_data);
        Session::flash('status','Your slide has been sucessfully add');
        return redirect()->route('madmin.slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        if(file_exists(public_path() . "/images/slide/" . $slide->images)) {
            unlink(public_path() . "/images/slide/" . $slide->images);
        }
        $slide->delete();
        Session::flash('status','Your slide has been sucessfully delete!');
        return redirect()->route('madmin.slides.index');
    }
}
