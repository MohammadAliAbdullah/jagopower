<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Attribute;
use App\Http\Requests\ProductRequest;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Atribute;
use App\Models\Product;
use App\Models\PurchaseDetails;
use App\Models\ProductStock;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\SeoMeta;
use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @modify by abdullah 12-05-2025
     */
    public function index(Request $request)
    {
        $query = Product::orderBy('id', 'DESC');

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10)->appends($request->all());

        return view('Admin.Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $values = Tag::select('title as value', 'title as text')->get();
        $parents = Category::where('type', 'Regular')->where('parent_id', 0)->get()->pluck('title', 'id')->toArray();
        $spacials = Category::where('type', 'Special')->get()->pluck('title', 'id')->toArray();
        $sub_cats = Category::where('parent_id', '!=', 0)->get()->pluck('title', 'id')->toArray();
        $brands = Brand::all()->pluck('title', 'id')->toArray();
        $units = Unit::all()->pluck('name', 'id')->toArray();
        $attributes = Atribute::where('parent_id', 0)->get();
        return view('Admin.Products.add', compact('parents', 'sub_cats', 'spacials', 'brands', 'units', 'attributes', 'values'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $var = explode(',', $data['tag']);
        $arra = [];
        foreach ($var as $vars) {
            $tag['title'] = $vars;
            $slug = str_slug($vars);
            $tagss = Tag::where('slug', $slug)->first();
            if ($tagss) {
                $arra[] = $tagss->id;
            } else {
                $tag['slug'] = $slug;
                $tags = Tag::create($tag);
                $arra[] = $tags->id;
            }
        }
        //thumb
        if ($file = $request->file('images')) {
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $img = preg_replace('/\s+/', '-', $time . '-thumbnail-180X178.' . $file->extension());
            $names = $img;
            $destinationPath = public_path('images/product');
            $img = Image::make($file->path());
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $product['thumb'] = $names;
        }
        //Images
        if ($file = $request->file('images')) {
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $img1 = preg_replace('/\s+/', '-', $time . '-photo-300X370.' . $file->extension());
            $names1 = $img1;
            $destinationPath = public_path('images/product');
            $img1 = Image::make($file->path());
            $img1->resize(2000, 2000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names1);
            $product['images'] = $names1;
        }
        //Gallery Images Upload
        if ($request->hasFile('gallery')) {
            $images = $request->file('gallery');
            //dd($images);
            foreach ($images as $item):
                $var = date_create();
                $time = date_format($var, 'YmdHis');
                $fileName = preg_replace('/\s+/', '-', $item->getClientOriginalName());
                $imageName = $time . '-' . $fileName;
                $item->move(public_path() . '/images/product/', $imageName);
                $arr1[] = $imageName;
            endforeach;
            $image = implode(",", $arr1);
            $product['gallery'] = $image;
        } else {
            $image = '';
            $product['gallery'] = $image;
        }
        $product['sku'] = $data['sku'];
        $product['regular_price'] = $data['regular_price'];
        $product['sales_price'] = $data['sales_price'];
        $product['title'] = $data['title'];
        $product['slug'] = $this->createSlug($data['title']);
        $product['category_id'] = $data['category_id'];
        if (!empty($data['sub_category_id'])) {
            $product['sub_category_id'] = $data['sub_category_id'];
        } else {
            $product['sub_category_id'] = 0;
        }
        if (!empty($data['brand_id'])) {
            $product['brand_id'] = $data['brand_id'];
        } else {
            $product['brand_id'] = 0;
        }
        $product['spacialcat_id'] = $data['spacialcat_id'] ?? 0;
        $product['qty'] = $data['qty'];
        $product['unit_id'] = $data['unit_id'];
        $product['featured'] = $data['featured'];
        $product['content'] = $data['content'];
        $product['specification'] = $data['specification'];
        $product['warrenty'] = $data['warrenty'];
        $product['status'] = $data['status'];
        if (!empty($data['color'])) {
            $product['color'] = implode(',', $data['color']);
        }
        if (!empty($data['size'])) {
            $product['size'] = implode(',', $data['size']);
        }
        if (!empty($data['blade'])) {
            $product['blade'] = implode(',', $data['blade']);
        }
        //dd($product);
        //Seo meta table insert
        $product['meta_tags'] = implode(',', $arra);
        $product['meta_title'] = $data['meta_title'];
        $product['meta_keyword'] = $data['meta_keyword'];
        $product['meta_description'] = $data['meta_description'];
        //dd($product);
        $prod = Product::create($product);

        // product stock insert if needed
        $stock['product_id'] = $prod->id;
        $stock['sku'] = $data['sku'];
        $stock['unit_id'] = $data['unit_id'];
        $stock['stock_qty'] = $data['qty'];
        $stock['ragular_price'] = $data['regular_price'];
        $stock['sales_price'] = $data['sales_price'];
        if (!empty($data['color'])) {
            $stock['colored'] = implode(',', $data['color']);
        }
        if (!empty($data['size'])) {
            $stock['sized'] = implode(',', $data['size']);
        }
        ProductStock::create($stock);

        $ptags = $arra;
        foreach ($ptags as $ptag) {
            $pdtag['product_id'] = $prod->id;
            $pdtag['tags_id'] = $ptag;
            ProductTag::create($pdtag);
        }
        Session::flash('status', 'Your product has been sucessfully add');
        return redirect()->route('madmin.products.index');
    }

    public function change_sub_category(Request $request)
    {
        $sub_cats = Category::where('parent_id', $request->id)->get();
        return $sub_cats;
    }
    //    public function tags(Request $request)
    //    {
    //        $data = Tag::select("title as value", "id","slug")
    //            ->where('title', 'LIKE', $request->get('search'). '%')
    //            ->get();
    //
    //        return response()->json($data);
    //    }
    public function tags()
    {
        //$values =Tag::select('title')->get();
        $values = Tag::select('title')->get();
        foreach ($values as $value) {
            $arr[] = $value->title;
        }
        return json_encode($arr);
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
        $values = Tag::select('title as value', 'title as text')->get();
        $product = Product::findOrFail($id);
        $parents = Category::where('parent_id', 0)->get()->pluck('title', 'id')->toArray();
        $sub_cats = Category::where('parent_id', '!=', 0)->get()->pluck('title', 'id')->toArray();
        $spacials = Category::where('type', 'Special')->get()->pluck('title', 'id')->toArray();
        $brands = Brand::all()->pluck('title', 'id')->toArray();
        $units = Unit::all()->pluck('name', 'id')->toArray();
        $seo_meta = SeoMeta::where('id', $product->meta_id)->first();
        //$stock = ProductStock::where('sku', $product->sku)->first();
        $attributes = Atribute::where('parent_id', 0)->get();
        return view('Admin.Products.edit', compact('values', 'seo_meta', 'product', 'parents', 'sub_cats', 'spacials', 'brands', 'units', 'attributes'));
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
        $var = explode(',', $data['tag']);
        $arra = [];
        foreach ($var as $vars) {
            $tag['title'] = $vars;
            $slug = str_slug($vars);
            $tagss = Tag::where('slug', $slug)->first();
            if ($tagss) {
                $arra[] = $tagss->id;
            } else {
                $tag['slug'] = $slug;
                $tags = Tag::create($tag);
                $arra[] = $tags->id;
            }
        }
        $product_edit = Product::findOrFail($id);
        //dd($stock_edit);
        if ($file = $request->file('images')) {
            if (file_exists(public_path() . "/images/product/" . $product_edit->thumb)) {
                unlink(public_path() . "/images/product/" . $product_edit->thumb);
            }
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $img = preg_replace('/\s+/', '-', $time . '-thumbnail-180X178.' . $file->extension());
            $names = $img;
            $destinationPath = public_path('images/product');
            $img = Image::make($file->path());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $product['thumb'] = $names;
        }
        //Images
        if ($file = $request->file('images')) {
            if (file_exists(public_path() . "/images/product/" . $product_edit->images)) {
                unlink(public_path() . "/images/product/" . $product_edit->images);
            }
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $img1 = preg_replace('/\s+/', '-', $time . '-photo-300X370.' . $file->extension());
            $names1 = $img1;
            $destinationPath = public_path('images/product');
            $img1 = Image::make($file->path());
            $img1->resize(2000, 2000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names1);
            $product['images'] = $names1;
        }
        //Gallery Images Upload
        if ($request->hasFile('gallery')) {
            $images = $request->file('gallery');
            //dd($images);
            foreach ($images as $item):
                $var = date_create();
                $time = date_format($var, 'YmdHis');
                $fileName = preg_replace('/\s+/', '-', $item->getClientOriginalName());
                $imageName = $time . '-' . $fileName;
                $item->move(public_path() . '/images/product/', $imageName);
                $arr[] = $imageName;
            endforeach;
            $image = implode(",", $arr);
            $product['gallery'] = $image;
        } else {
            $image = '';
            //$product['gallery']=$image;
        }
        $product['sku'] = $data['sku'];
        $product['regular_price'] = $data['regular_price'];
        $product['sales_price'] = $data['sales_price'];
        $product['title'] = $data['title'];
        if ($data['title'] == $product_edit->title) {
            $product['slug'] = $product_edit->slug;
        } else {
            $product['slug'] = $this->createSlug($data['title']);
        }
        $product['category_id'] = $data['category_id'];
        if (!empty($data['sub_category_id'])) {
            $product['sub_category_id'] = $data['sub_category_id'];
        } else {
            $product['sub_category_id'] = 0;
        }
        if (!empty($data['brand_id'])) {
            $product['brand_id'] = $data['brand_id'];
        } else {
            $product['brand_id'] = 0;
        }
        $product['spacialcat_id'] = $data['spacialcat_id'] ?? 0;
        $product['qty'] = $data['qty'];
        $product['unit_id'] = $data['unit_id'];
        $product['featured'] = $data['featured'];
        $product['content'] = $data['content'];
        $product['specification'] = $data['specification'];
        $product['warrenty'] = $data['warrenty'];
        $product['status'] = $data['status'];
        if (!empty($data['colord'])) {
            $product['color'] = implode(',', $data['colord']);
        }
        if (!empty($data['sized'])) {
            $product['size'] = implode(',', $data['sized']);
        }
        if (!empty($data['bladed'])) {
            $product['blade'] = implode(',', $data['bladed']);
        }
        //dd($product);
        //Seo meta table insert
        $product['meta_tags'] = implode(',', $arra);
        $product['meta_title'] = $data['meta_title'];
        $product['meta_keyword'] = $data['meta_keyword'];
        $product['meta_description'] = $data['meta_description'];
        $product_edit->update($product);

        //Product_stock insert
        $stocks = ProductStock::where('product_id', $product_edit->id)->first();
        if ($stocks == NULL) {
            $stock['product_id'] = $product_edit->id;
            $stock['sku'] = $data['sku'];
            $stock['unit_id'] = $data['unit_id'];
            $stock['stock_qty'] = $data['qty'];
            $stock['ragular_price'] = $data['regular_price'];
            $stock['sales_price'] = $data['sales_price'];
            if (!empty($data['colord'])) {
                $stock['color'] = implode(',', $data['colord']);
            }
            if (!empty($data['sized'])) {
                $stock['size'] = implode(',', $data['sized']);
            }
            ProductStock::create($stock);
        } else {
            $stock['sku'] = $data['sku'];
            $stock['unit_id'] = $data['unit_id'];
            $stock['stock_qty'] = $data['qty'];
            $stock['ragular_price'] = $data['regular_price'];
            $stock['sales_price'] = $data['sales_price'];
            if (!empty($data['colord'])) {
                $stock['color'] = implode(',', $data['colord']);
            }
            if (!empty($data['sized'])) {
                $stock['size'] = implode(',', $data['sized']);
            }
            $stocks->update($stock);
        }

        foreach (ProductTag::where('product_id', $product_edit->id)->get() as $ptag) {
            $ptagss = ProductTag::where('id', $ptag->id)->first();
            $ptagss->delete();
        }
        $ptags = $arra;
        foreach ($ptags as $ptag) {
            $pdtag['product_id'] = $product_edit->id;
            $pdtag['tags_id'] = $ptag;
            ProductTag::create($pdtag);
        }
        //$stock_edit->update($stock);
        Session::flash('status', 'Your product has been sucessfully Updated!');
        return redirect()->route('madmin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        //$product_stock = ProductStock::where('sku', $product->sku)->delete();
        SeoMeta::where('id', $product->meta_id)->delete();
        $product->delete();

        Session::flash('status', 'Your product has been sucessfully deleted!');
        return redirect()->route('madmin.products.index');
    }
    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)) {
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
        return Product::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
