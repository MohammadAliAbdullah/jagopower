<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactInfo;
use App\Models\Faq;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewReply;
use Auth;

class PagesController extends Controller
{
    public function shop()
    {
        $cat_products=cache()->remember('cat_products-shopn', 60*60*24, function(){
            return Product::orderBy('id','DESC')->paginate(20);
        });
        $brands=cache()->remember('brands-shopn', 60*60*24, function(){
            return Brand::all();
        });
        $categories=cache()->remember('categories-shopn', 60*60*24, function(){
            return Category::where('type', 'Regular')->where('parent_id',0)->get();
        });
        //$cat_products=Product::orderBy('id','DESC')->paginate(20);
        //dd($cat_products);
        //$brands = Brand::all();
        //$categories = Category::where('type', 'Regular')->where('parent_id',0)->get();
        return view("Frontend.shop", compact('cat_products','brands', 'categories'));
    }

    public function shopfilter(Request $request)
    {
//        $category=cache()->remember('shopfilter', 60*60*24, function() use($request->action){
//            return Category::where('slug', $request->action)->first();
//        });
        //$category=Category::where('slug', $request->action)->first();
        if(isset($request->brand) OR isset($request->category) OR isset($request->size) OR isset($request->color) OR isset($request->price)){
            $products = DB::table('products as p')
                //->join('product_attributes as pa','p.id','=','pa.product_id')
                ->select('p.*')
                ->where('p.status', 'Active');
                //->groupBy('p.id');

            if (isset($request->price)) {
                //$price = implode(",",$request->price);
                $price = explode("-",implode(",", $request->price));
                //return $price[1];
                //$products->whereRaw('p.regular_price IN(p.regular_price BETWEEN '.$price[0].' AND '.$price[1].')');
                //$products->whereRaw('p.regular_price >= '.$price[0].' AND p.regular_price <= '.$price[1]);
                //$products->whereRaw('p.sales_price BETWEEN '.$price[0].' AND '.$price[1]);
                $products->whereRaw('p.regular_price BETWEEN ' . $price[0] . ' AND ' . $price[1] . '');
                //$products->orWhereBetween('p.sales_price', [$price[0], $price[2]]);
            }
            if (isset($request->brand)) {
                $brand_filter = implode(",", $request->brand);
                //return $brand_filter;
                $products->whereRaw('p.brand_id IN ('.$brand_filter.')');
            }
            if (isset($request->category)) {
                $category = implode(",", $request->category);
                $products->whereRaw('p.category_id IN ('.$category.') OR p.sub_category_id IN('.$category.')');
                //$products->whereRaw('p.sub_category_id IN ('.$category.')');
                //return $category;
            }
//            else{
//                $products->whereRaw('p.sub_category_id ('.$category.')');
//            }
            if (isset($request->size)) {
                $size = implode(",", $request->size);
                $products->whereRaw('p.size IN ('.$size.')');
            }
            if (isset($request->color)) {
                $color = implode(",", $request->color);
                $products->whereRaw('p.color IN ('.$color.')');
            }

            $cat_products = $products->paginate(20);
            //return $cat_products;
            $brands = Brand::all();
            $categories = Category::where('type', 'Regular')->where('parent_id',0)->get();
            return view("Frontend.ajax", compact('cat_products','brands', 'categories'));
        }else{
            $cat_products = Product::where('category_id',$category->id)->orWhere('sub_category_id',$category->id)->paginate(20);
            $brands = Brand::all();
            $categories = Category::where('type', 'Regular')->where('parent_id',0)->get();
            return view("Frontend.ajax", compact('cat_products','brands', 'categories'));
        }
    }

    public function deals()
    {
    	return view("Frontend.deals");
    }
    public function track(Request $request)
    {
        if ($request->search){
            $order=Order::where('invoice_no',$request->search)->first();
            //dd($order);
            $orders=OrderDetails::where('order_id', $order->id)->get();
            return view("Frontend.track", compact('order','orders'));
        }else{
            $order=NULL;
            $orders=NULL;
            return view("Frontend.track", compact('order','orders'));
        }

    }
    public function about_us()
    {
        $about=cache()->remember('about-us', 60*60*24, function(){
            return AboutUs::where('id',1)->first();
        });
        return view("Frontend.Page.about_us", compact('about'));
    } 
    public function contact_us()
    {
//        return cache()->remember('contact-us', 60*60*24, function(){
//            $shop=ContactInfo::where('id',1)->first();
//            $office=ContactInfo::where('id',2)->first();
//        });
//        dd($office);
//        $shop=cache()->remember('contact-us', 60*60*24, function(){
//            ContactInfo::where('id',1)->first();
//        });
        $shop=ContactInfo::where('id',1)->first();
        $office=ContactInfo::where('id',2)->first();
        return view("Frontend.Page.contact_us", compact('shop','office'));
    }
    public function page($slug)
    {
        $about=cache()->remember('pages', 60*60*24, function() use($slug){
           return Page::where('slug',$slug)->first();
        });
        return view("Frontend.Page.page", compact('about'));
    }

    public function faq()
    {
        $values=Faq::where('status','Active')->get();
        return view("Frontend.Page.faq", compact('values'));
    }

    public function warranty_policy()
    {
        $page=Page::where('id',1)->first();
        //dd($page);
        return view("Frontend.warranty_policy",compact('page'));
    }
    public function trams()
    {
        $page=Page::where('id',2)->first();
        return view("Frontend.trams_condition", compact('page'));
    }
    public function privacy()
    {
        $page=Page::where('id',3)->first();
        return view("Frontend.privacy", compact('page'));
    }

    public function brand()
    {
        $brands=Brand::where('status','Active')->get();
        return view("Frontend.brand", compact('brands'));
    }

    public function product_details($id=NULL)
    {
//        $product=cache()->remember('product-pdeteails', 60*60*24, function() use($id){
//            return Product::where('slug', $id)->first();
//        });
//        $pid=$product->id;
//        $pcat=$product->category_id;
//        $reviews=cache()->remember('reviews-pdeteails', 60*60*24, function() use($pid){
//            return Review::where('product_id', $pid)->where('status','Active')->get();
//        });
//        $similar_products=cache()->remember('similar_products-pdeteails', 60*60*24, function() use($pcat){
//            return Product::where('category_id', $pcat)->take(5)->get();
//        });
//        $other_products=cache()->remember('other_products-pdeteails', 60*60*24, function() use($pcat){
//            return Product::where('category_id', $pcat)->take(5)->get();
//        });
        $product = Product::where('slug', $id)->first();
        $reviews = Review::where('product_id', $product->id)->where('status','Active')->get();
        $gallery = explode(',', $product->gallery);
        //dd($product);
        $similar_products = Product::where('category_id', $product->category_id)->take(5)->get();
        $other_products = Product::where('category_id', $product->category_id)->take(5)->get();
        return view("Frontend.simple_product", compact('similar_products','product', 'gallery', 'reviews','other_products'));
    }
    public function product_quick_view_details($id=NULL)
    {
//        $product=cache()->remember('product-pdeteails', 60*60*24, function() use($id){
//            return Product::where('slug', $id)->first();
//        });
//        $pid=$product->id;
//        $pcat=$product->category_id;
//        $reviews=cache()->remember('reviews-pdeteails', 60*60*24, function() use($pid){
//            return Review::where('product_id', $pid)->where('status','Active')->get();
//        });
//        $similar_products=cache()->remember('similar_products-pdeteails', 60*60*24, function() use($pcat){
//            return Product::where('category_id', $pcat)->take(5)->get();
//        });
//        $other_products=cache()->remember('other_products-pdeteails', 60*60*24, function() use($pcat){
//            return Product::where('category_id', $pcat)->take(5)->get();
//        });
        $product = Product::where('slug', $id)->first();
        $reviews = Review::where('product_id', $product->id)->where('status','Active')->get();
        $gallery = explode(',', $product->gallery);
        //dd($product);
        $similar_products = Product::where('category_id', $product->category_id)->take(5)->get();
        $other_products = Product::where('category_id', $product->category_id)->take(5)->get();
        return view("Frontend.product_quick_view", compact('similar_products','product', 'gallery', 'reviews','other_products'));
    }

    public function review_store(Request $request)
    {
        //dd($customer_id);
//        if ($customer_id == "empty") {
//            //Session::flash('error','Please login to review this product!');
//            return redirect()->route('mypanel.elogin');
//        }else{
            $data = $request->all();
            //$data['admin_id'] = '';
            $data['status'] ="Pending";
            $data['product_id'] = $data['product_id'];
            $data['customer_id	'] = $data['customer_id'];
            $data['content'] = $data['message'];
            $data['rating'] = $data['rating'];
            //dd($data);
            Review::create($data);
            Session::flash('status','Review succeed!');
            return back();
//        }
    }

    public function review_index()
    {
        $reviews = Review::paginate(10);

        return view("Admin.Reviews.index", compact('reviews'));
    }

    public function review_reply($id)
    {
        $review = Review::findOrFail($id);
        $review_reply = ReviewReply::where('review_id', $review->id)->first();
        return view("Admin.Reviews.reply", compact('review', 'review_reply'));
    }

    public function reply_store(Request $request, $review_id, $customer_id, $admin_id)
    {

        $data = $request->all();
        $data['customer_id'] = $customer_id;
        $data['review_id'] = $review_id;
        $data['admin_id'] = $admin_id;

        $has_reply = ReviewReply::where('review_id', $review_id)->first();
        if ($has_reply) {
            $has_reply->update($data);
        }else{
            ReviewReply::create($data);
        }
        

        $review = Review::findOrFail($review_id);
        $review_status['status'] = $data['status'];

        $review->update($review_status);

        Session::flash('status','Your reply has been sucessfully added');
        return redirect()->route('madmin.review_index');
    }

}
