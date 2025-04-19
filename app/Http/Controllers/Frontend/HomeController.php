<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Atribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides=cache()->remember('slide', 60*60*24, function(){
            return Slide::where('status','Active')->get();
        });
        $categories=cache()->remember('categories-home', 60*60*24, function(){
            return Category::orderBy('orders','ASC')->where('type', 'Regular')->where('parent_id',0)->limit(6)->get();
        });
        $spacials=cache()->remember('spacials-home', 60*60*24, function(){
            return Category::where('type', 'Special')->where('parent_id',0)->limit(8)->get();
        });
        $home1=cache()->remember('home1-home', 60*60*24, function(){
            return Banner::where('position','Home1')->first();
        });
        $home2=cache()->remember('home2-home', 60*60*24, function(){
            return Banner::where('position','Home2')->first();
        });
        $home3=cache()->remember('home3-home', 60*60*24, function(){
            return Banner::where('position','Home3')->first();
        });
        $spproducts=cache()->remember('spproducts-home', 60*60*24, function(){
            return Product::orderBy('id','DESC')->where('spacialcat_id','!=',0)->limit(6)->get();
        });
        $blogs=cache()->remember('blogs-home', 60*60*24, function(){
            return Blog::orderBy('id','DESC')->where('status','Active')->limit(3)->get();
        });
        //$slides = Slide::where('status','Active')->get();
        //$categories = Category::orderBy('orders','ASC')->where('type', 'Regular')->where('parent_id',0)->limit(6)->get();
        //$spacials = Category::where('type', 'Special')->where('parent_id',0)->limit(8)->get();
//        $home1 = Banner::where('position','Home1')->first();
//        $home2 = Banner::where('position','Home2')->first();
//        $home3 = Banner::where('position','Home3')->first();
        //$spproducts = Product::orderBy('id','DESC')->where('spacialcat_id','!=',0)->limit(6)->get();
        //$blogs=Blog::orderBy('id','DESC')->where('status','Active')->limit(3)->get();
        return view("Frontend.index", compact('slides','categories','home1','home2','home3','spproducts','spacials','blogs'));
    }
    public function search(Request $request)
    {
        $query = $request->search;
        $cat_products=Product::
            where('title', 'LIKE',"%$query%")
            //->orWhere('specification', 'LIKE',"%$query%")
            //->orWhere('warrenty', 'LIKE',"%$query%")
            ->paginate(24);
        //dd($products);
        return view("Frontend.search", compact('cat_products'));
    }
    public function today_offer()
    {
        $todate = Carbon::now()->toDateString();
        $discounts = Discount::where('start_date', '<', $todate)->where('end_date', '>', $todate)->where('status', '=', 'Ongoing')->get();
//        $discounts_product_id = [];
//        foreach ($discounts as $discount) {
//            $discount_array = explode(',', $discount->product_id);
//            foreach ($discount_array as $item) {
//                array_push($discounts_product_id, $item);
//            }
//        }
//        $discount_ids = array_unique($discounts_product_id);
//        $products = [];
//        foreach ($discount_ids as $id) {
//            $product = Product::findOrFail($id);
//            array_push($products, $product);
//        }
        //$products = Product::limit(36)->get();
        return view("Frontend.today_offer", compact('discounts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_page_1()
    {
        return view("Frontend.home_page_1");
    }

    public function home_page_2()
    {
        return view("Frontend.home_page_2");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view("Frontend.login");
    }

    public function register()
    {
        return view("Frontend.create_account");
    }

    public function shop_by_category($slug)
    {
//        $category=cache()->remember('cat-categoyr', 60*60*24, function() use($slug){
//            return Category::where('slug', $slug)->first();
//        });
//        $catid=$category->id;
//        $cat_products=cache()->remember('cat_products-categoyr', 60*60*24, function() use($catid){
//            return Product::where('category_id',$catid)->orWhere('sub_category_id',$catid)->paginate(20);
//        });
//        $subcats=cache()->remember('subcats-categoyr', 60*60*24, function() use($catid){
//            return Product::groupBy('sub_category_id')->select('sub_category_id')->where('category_id',$catid)->where('sub_category_id','!=',0)->get();
//        });
//        $brands=cache()->remember('brands-categoyr', 60*60*24, function() use($catid){
//            return Product::groupBy('brand_id')->select('brand_id')->where('category_id',$catid)->where('brand_id','!=',0)->get();
//        });
//        $categories=cache()->remember('categories-categoyr', 60*60*24, function() use($catid){
//            return Category::where('type', 'Regular')->where('parent_id',$catid)->get();
//        });
//        $colorss=cache()->remember('colorss-categoyr', 60*60*24, function() use($catid){
//            return Product::select('color')->where('category_id',$catid)->where('color','!=',NULL)->get();
//        });
//        $sizess=cache()->remember('sizess-categoyr', 60*60*24, function() use($catid){
//            return Product::select('size')->where('category_id',$catid)->where('size','!=',NULL)->get();
//        });
        $category=Category::where('slug', $slug)->first();
        $cat_products = Product::where('category_id',$category->id)->orWhere('sub_category_id',$category->id)->paginate(20);
        $subcats=Product::groupBy('sub_category_id')->select('sub_category_id')->where('category_id',$category->id)->where('sub_category_id','!=',0)->get();
        $brands = Product::groupBy('brand_id')->select('brand_id')->where('category_id',$category->id)->where('brand_id','!=',0)->get();
        $categories = Category::where('type', 'Regular')->where('parent_id',$category->id)->get();
        $colorss=Product::select('color')->where('category_id',$category->id)->where('color','!=',NULL)->get();
        $sizess=Product::select('size')->where('category_id',$category->id)->where('size','!=',NULL)->get();
        return view("Frontend.shopbycategory", compact('cat_products','brands','category', 'categories','subcats','colorss','sizess'));
    }

    public function shop_by_brand($slug)
    {
//        $brand=cache()->remember('brand-brand', 60*60*24, function() use($slug){
//            return Brand::where('slug', $slug)->first();
//        });
//        $catid=$brand->id;
//        $cat_products=cache()->remember('categ-brand', 60*60*24, function() use($catid){
//            return Product::where('brand_id',$catid)->orWhere('sub_category_id',$catid)->paginate(20);
//        });
//        $all_partners=cache()->remember('allpa-brand', 60*60*24, function(){
//            return Brand::all()->toArray();
//        });
        $brand=Brand::where('slug', $slug)->first();
        $subcats=Category::where('parent_id', $category->id)->get();
        $cat_products = Product::where('brand_id',$brand->id)->orWhere('sub_category_id',$brand->id)->paginate(20);
        $all_partners = Brand::all()->toArray();
        return view("Frontend.shopbybrand", compact('cat_products','brand','all_partners'));
    }
    public function shop_by_shop($category,$brand)
    {
//        $brand=cache()->remember('brand-shoby', 60*60*24, function() use($brand){
//            return Brand::where('slug', $brand)->first();
//        });
//        $brandid=$brand->id;
//        $category=cache()->remember('category-shoby', 60*60*24, function() use($category){
//            return Category::where('slug', $category)->first();
//        });
//        $catid=$category->id;
//        $cat_products=cache()->remember('cat_products-shoby', 60*60*24, function() use($catid,$brandid){
//            return Product::where('brand_id',$brandid)->where('category_id',$catid)->orWhere('sub_category_id',$catid)->paginate(20);
//        });
//
//        $all_partners=cache()->remember('allpa-shoby', 60*60*24, function(){
//            return Brand::all()->toArray();
//        });
        $brand=Brand::where('slug', $brand)->first();
        //dd($brand);
        $category=Category::where('slug', $category)->first();
        $cat_products = Product::where('brand_id',$brand->id)->where('category_id',$category->id)->orWhere('sub_category_id',$category->id)->paginate(20);
        $all_partners = Brand::all()->toArray();
        //dd($cat_products);
        return view("Frontend.shopinshop", compact('cat_products','brand','all_partners','category'));
    }

    public function shopfilters(Request $request)
    {
//        $prices=explode("-",implode(",", $request->price));
        //return json_encode($request->category);
        //exit();

        if(isset($request->brand) OR isset($request->category) OR isset($request->size) OR isset($request->color) OR isset($request->price)){
            $products = DB::table('products as p')
                //->join('product_attributes as pa','p.id','=','pa.product_id')
                ->select('p.*')
                ->where('p.status', 'Active');
            //->groupBy('p.id');

            if (isset($request->price)) {
                $price = explode("-",implode(",", $request->price));
                $products->whereRaw('p.regular_price BETWEEN ' . $price[0] . ' AND ' . $price[1] .'');
                $products->whereRaw('p.sales_price BETWEEN ' . $price[0] . ' AND ' . $price[1] .'');
            }
            if (isset($request->brand)) {
                $brand_filter = implode(",", $request->brand);
                $products->whereRaw('p.brand_id IN ('.$brand_filter.')');
            }
            if (isset($request->category)) {
                $category = implode(",", $request->category);
                $products->whereRaw('p.sub_category_id IN('.$category.')');
            }else{
                $category=Category::where('slug', $request->action)->first();
                $products->whereRaw('p.category_id IN('.$category->id.')');
            }
            if (isset($request->size)) {
                $size = implode(",", $request->size);
                $products->whereRaw('p.size IN ('.$size.')');
            }
            if (isset($request->color)) {
                $color = implode(",", $request->color);
                $products->whereRaw('p.color IN ('.$color.')');
            }

            $cat_products = $products->get();
            $brands = Brand::all();
            $categories = Category::where('type', 'Regular')->where('parent_id',0)->get();
            return view("Frontend.ajax", compact('cat_products','brands', 'categories'));
        }else{
            $subcats=\App\Models\Product::groupBy('sub_category_id')->select('sub_category_id')->where('category_id',$category->id)->where('sub_category_id','!=',0)->get();
            //$brands=\App\Models\Product::groupBy('brand_id')->select('brand_id')->where('category_id',$category->id)->where('brand_id','!=',0)->get();
            $colorss=\App\Models\Product::select('color')->where('category_id',$category->id)->where('color','!=',NULL)->get();
            $sizess=\App\Models\Product::select('size')->where('category_id',$category->id)->where('size','!=',NULL)->get();
            $bladess=\App\Models\Product::select('blade')->where('category_id',$category->id)->where('blade','!=',NULL)->get();

            $category=Category::where('slug', $request->action)->first();
            $cat_products = Product::where('category_id',$category->id)->orWhere('sub_category_id',$category->id)->paginate(20);
            $brands = Brand::all();
            $categories = Category::where('type', 'Regular')->where('parent_id',0)->get();
            return view("Frontend.ajax", compact('cat_products','brands', 'categories','subcats','colorss','sizess','bladess'));
        }
    }

    public function collection($category,$value)
    {

        //$cat_slide = Category::all();
        $atribute=Atribute::where('slug', $value)->first();
        //dd($atribute->attribute_parent->name);
        $category=Category::where('slug', $category)->first();
        if ($atribute->attribute_parent->slug=='color'){
            $cat_products = Product::where('category_id',$category->id)->whereRaw("find_in_set('".$atribute->id."',products.color)")->paginate(20);
        }elseif ($atribute->attribute_parent->slug=='size'){
            $cat_products = Product::where('category_id',$category->id)->whereRaw("find_in_set('".$atribute->id."',products.size)")->paginate(20);
        }elseif ($atribute->attribute_parent->slug=='blade'){
            $cat_products = Product::where('category_id',$category->id)->whereRaw("find_in_set('".$atribute->id."',products.blade)")->paginate(20);
        }
        $all_partners = Brand::all()->toArray();
        return view("Frontend.shopinshop", compact('cat_products','all_partners','category'));
    }
    public function price($category,$slug)
    {

        $amount=explode('-',$slug);
        //dd($amount[1]);
        $category=Category::where('slug', $category)->first();
        $cat_products = Product::where('category_id',$category->id)
            ->orWhere('sub_category_id',$category->id)
            ->whereBetween('regular_price',[$amount[0],$amount[1]])
            ->orWhereBetween('sales_price', [$amount[0],$amount[1]])
            ->paginate(20);
        $all_partners = Brand::all()->toArray();
        //dd($cat_products);
        return view("Frontend.shopinshop", compact('cat_products','all_partners','category'));
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
        //
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
        //
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
