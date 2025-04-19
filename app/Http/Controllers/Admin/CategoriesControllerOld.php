<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\SeoMeta;
use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('Admin.Categories.index',compact('categories'));
    }

    public function spacial()
    {
        $categories = Category::where('type','Special')->paginate(10);
        return view('Admin.Categories.index',compact('categories'));
    }

    public function regular()
    {
        $categories = Category::where('type','Regular')->paginate(10);
        return view('Admin.Categories.index',compact('categories'));
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
    public function store(Category $request)
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
        $category['type'] = $data['type'];
        $category['status'] = $data['status'];
        $category['parent_id'] = $data['parent_id'];
//dd($category);
        $category['img_alt']=$data['img_alt'];
        $category['smm_title']=$data['smm_title'];
        $category['smm_content']=$data['smm_content'];
        $category['meta_title']=$data['meta_title'];
        $category['meta_description']=$data['meta_description'];
        $category['meta_keyword']=$data['meta_keyword'];
        $category['schema']=$data['schema'];
        $category['follow']=$data['follow'];
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
        $parents = Category::where('parent_id', 0)->get()->pluck('title','id')->toArray();
        $category = Category::findOrFail($id);
        $seo_meta = SeoMeta::where('id', $category->meta_id)->first();
        return view('Admin.Categories.edit', compact('category', 'seo_meta', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $request, $id)
    {
        $data = $request->all();
        $category_edit = Category::findOrFail($id);

        if($file=$request->file('image')){
//            if(file_exists(public_path("/images/category/" . $category_edit->thumb))) {
//                unlink(public_path() . "/images/category/" . $category_edit->thumb);
//            }
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
        dd($category_edit);
        if($file=$request->file('image')){
//            if(file_exists(public_path() . "/images/category/" . $category_edit->images)) {
//                unlink(public_path() . "/images/category/" . $category_edit->images);
//            }
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
//            if(file_exists(public_path("/images/category/" . $category_edit->banner))) {
//                unlink(public_path() . "/images/category/" . $category_edit->banner);
//            }
            $img=preg_replace('/\s+/', '-','banner.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/category/');
            $img = Image::make($file->path());
            $img->resize(500, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $category['banner']=$names;
        }
        $category['title'] = $data['title'];
        if($data['title']==$category_edit->title){
            $category['slug']=$category_edit->slug;
        }else{
            $category['slug']=$this->createSlug($data['title']);
        }
        $category['type'] = $data['type'];
        $category['content'] = $data['content'];
        $category['parent_id'] = $data['parent_id'];
        $category['img_alt']=$data['img_alt'];
        $category['status'] = $data['status'];
        $category['smm_title']=$data['smm_title'];
        $category['smm_content']=$data['smm_content'];
        $category['meta_title']=$data['meta_title'];
        $category['meta_description']=$data['meta_description'];
        $category['meta_keyword']=$data['meta_keyword'];
        $category['schema']=$data['schema'];
        $category['follow']=$data['follow'];
        $category_edit->update($category);
        Session::flash('status','Your Category has been sucessfully Updated!');
        return redirect()->route('madmin.categories.index');
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
//        if(file_exists(public_path() . "/images/category/" . $category->banner)) {
//            unlink(public_path() . "/images/category/" . $category->banner);
//        }
//        if(file_exists(public_path() . "/images/category/" . $category->images)) {
//            unlink(public_path() . "/images/category/" . $category->images);
//        }
//        if(file_exists(public_path() . "/images/category/" . $category->thumb)) {
//            unlink(public_path() . "/images/category/" . $category->thumb);
//        }
//        $products = $category->products;
//        foreach ($products as $product) {
//            $product->productstock->delete();
//            //$product->seometa->delete();
//            $product->delete();
//        }

        //SeoMeta::where('id', $category->meta_id)->delete();
        $category->delete();
        Session::flash('status','Your Category has been sucessfully deleted with child products!');
        return redirect()->route('madmin.categories.index');
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
        return Category::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
