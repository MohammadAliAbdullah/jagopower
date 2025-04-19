<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = AboutUs::paginate(10);
        return view('Admin.About.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::where('parent_id', 0)->get()->pluck('title','id')->toArray();
        return view('Admin.Categories.add', compact('parents'));
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
        if($file=$request->file('image')){
            $img=preg_replace('/\s+/', '-','thumb.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/category/');
            $img = Image::make($file->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $category['thumb']=$names;
        }
        if($file=$request->file('image')){
            $img=preg_replace('/\s+/', '-','images.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/category/');
            $img = Image::make($file->path());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $category['images']=$names;
        }
        if($file=$request->file('banner')){
            $img=preg_replace('/\s+/', '-','banner.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/category/');
            $img = Image::make($file->path());
            $img->resize(1000, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $category['banner']=$names;
        }
        $category['title'] = $data['title'];
        $category['slug']=$this->createSlug($data['title']);
        $category['status'] = $data['status'];
        $category['parent_id'] = $data['parent_id'];
//dd($category);
        $category['meta_title'] = $data['meta_title'];
        $category['meta_keyword'] = $data['meta_keyword'];
        $category['meta_description'] = $data['meta_description'];
        Category::create($category);
        Session::flash('status','Your Category has been sucessfully add');
        return redirect()->route('madmin.categories.index');
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
        $category = AboutUs::findOrFail($id);
        return view('Admin.About.edit', compact('category'));
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
        $category_edit = AboutUs::findOrFail($id);
        $category['about_title'] = $data['about_title'];
        $category['content'] = $data['content'];
        $category['mission'] = $data['mission'];
        $category['vision'] = $data['vision'];
        $category['establistmet'] = $data['establistmet'];
        $category_edit->update($category);
        Session::flash('status','Your About Us has been sucessfully Updated!');
        return redirect()->route('madmin.aboutadmin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if(file_exists(public_path() . "/images/category/" . $category->banner)) {
            unlink(public_path() . "/images/category/" . $category->banner);
        }
        if(file_exists(public_path() . "/images/category/" . $category->images)) {
            unlink(public_path() . "/images/category/" . $category->images);
        }
        if(file_exists(public_path() . "/images/category/" . $category->thumb)) {
            unlink(public_path() . "/images/category/" . $category->thumb);
        }
        $products = $category->products;
        foreach ($products as $product) {
            $product->productstock->delete();
            //$product->seometa->delete();
            $product->delete();
        }

        //SeoMeta::where('id', $category->meta_id)->delete();
        $category->delete();
        Session::flash('status','Your Category has been sucessfully deleted with child products!');
        return redirect()->route('madmin.categories.index');
    }
}
