<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\SeoMeta;
use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::paginate(10);
        return view('Admin.Brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Brands.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $data = $request->all();
        if($file=$request->file('image')){
            $img=preg_replace('/\s+/', '-','thumb.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/brand/');
            $img = Image::make($file->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $brand['thumb']=$names;
        }
        if($file=$request->file('image')){
            $img=preg_replace('/\s+/', '-','images.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/brand/');
            $img = Image::make($file->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $brand['images']=$names;
        }
        if($file=$request->file('banner')){
            $img=preg_replace('/\s+/', '-','banner.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/brand/');
            $img = Image::make($file->path());
            $img->resize(1000, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $brand['banner']=$names;
        }
        if($file1=$request->file('smm_images')){
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            //dd($oldData->photo);
            $img=preg_replace('/\s+/', '-page','.'. $file1->extension());
            $names1=time().$img;
            //$destinationPath = '/public/images';
            $destinationPath = public_path('/images/brand');
            //dd($destinationPath.$names);
            $img = Image::make($file1->path());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names1);
            //$file1->move($destinationPath, $names);
            $brand['smm_images']=$destinationPath.'/'.$names1;
        }
        $brand['title'] = $data['title'];
        $brand['slug']=$this->createSlug($data['title']);
        $brand['content'] = $data['content'];
        $brand['status'] = $data['status'];
        $brand['img_alt']=$data['img_alt'];
        $brand['smm_title']=$data['smm_title'];
        $brand['smm_content']=$data['smm_content'];
        $brand['meta_title']=$data['meta_title'];
        $brand['meta_description']=$data['meta_description'];
        $brand['meta_keyword']=$data['meta_keyword'];
        $brand['schema']=$data['schema'];
        $brand['follow']=$data['follow'];
        Brand::create($brand);
        Session::flash('status','Your brand has been sucessfully add');
        return redirect()->route('madmin.brands.index');

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
        $brand = Brand::findOrFail($id);
        $seo_meta = SeoMeta::where('id', $brand->meta_id)->first();
        return view('Admin.Brands.edit', compact('brand', 'seo_meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $data = $request->all();
        $brand_edit = Brand::findOrFail($id);
        $data = $request->all();
        if($file=$request->file('image')){
            if(file_exists(public_path() . "/images/brand/" . $brand_edit->thumb) AND $brand_edit->thumb!=NULL) {
                unlink(public_path() . "/images/brand/" . $brand_edit->thumb);
            }
            $img=preg_replace('/\s+/', '-','thumb.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/brand/');
            $img = Image::make($file->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $brand['thumb']=$names;
        }
        if($file=$request->file('image')){
            if(file_exists(public_path() . "/images/brand/" . $brand_edit->images)  AND $brand_edit->images!=NULL) {
                unlink(public_path() . "/images/brand/" . $brand_edit->images);
            }
            $img=preg_replace('/\s+/', '-','images.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/brand/');
            $img = Image::make($file->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $brand['images']=$names;
        }
        if($file=$request->file('banner')){
            if(file_exists(public_path() . "/images/brand/" . $brand_edit->banner)  AND $brand_edit->banner!=NULL) {
                unlink(public_path() . "/images/brand/" . $brand_edit->banner);
            }
            $img=preg_replace('/\s+/', '-','banner.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/brand/');
            $img = Image::make($file->path());
            $img->resize(1000, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $brand['banner']=$names;
        }
        if($file1=$request->file('smm_images')){
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            //dd($oldData->photo);
            $img=preg_replace('/\s+/', '-page','.'. $file1->extension());
            $names1=time().$img;
            //$destinationPath = '/public/images';
            $destinationPath = public_path('/images/brand');
            //dd($destinationPath.$names);
            $img = Image::make($file1->path());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names1);
            //$file1->move($destinationPath, $names);
            $brand['smm_images']=$destinationPath.'/'.$names1;
        }
        $brand['title'] = $data['title'];
        if ($brand_edit->title!=$data['title']){
            $brand['slug']=$this->createSlug($data['title']);
        }
        $brand['content'] = $data['content'];
        $brand['status'] = $data['status'];
        $brand['img_alt']=$data['img_alt'];
        $brand['smm_title']=$data['smm_title'];
        $brand['smm_content']=$data['smm_content'];
        $brand['meta_title']=$data['meta_title'];
        $brand['meta_description']=$data['meta_description'];
        $brand['meta_keyword']=$data['meta_keyword'];
        $brand['schema']=$data['schema'];
        $brand['follow']=$data['follow'];
        $brand_edit->update($brand);
        Session::flash('status','Your brand has been sucessfully updated!');
        return redirect()->route('madmin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        Session::flash('status','Your brand & associate product has been deleted!');
        return redirect()->route('madmin.brands.index');

    }
    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Brand::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
