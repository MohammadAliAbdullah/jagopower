<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Brand;
use Cart;
use Auth;
use Illuminate\Support\Facades\URL;

class CartsController extends Controller
{

    var $default_userID =  "user_not_logged_id";

    public function cart(){
        $cartCollection = Cart::getContent();
        $cartTotal = Cart::gettotal();
        //dd($cartCollection);
        return view('Frontend.cart', compact('cartCollection','cartTotal'));
    }

    public function add(Request $request){
        //dd($request->all());
        Session::put('url.intended',URL::previous());
        Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->thumbnail_img,
                'slug' => $request->slug,
                'colored'=>$request->attribute_pa_color,
            )
        ));

        //if(\Illuminate\Support\Facades\Auth::guard('customer')->user()!=null){
          //  $cid=Auth::guard('customer')->user()->id;

//        $wishdel=Wishlist::where('product_id',$request->id)->where('user_id',$cid)->first();
//
//        if($wishdel!=NULL){
//            $wishdel->delete();
//        }
//
       // }

        if(Session::get('url.intended')){
            return Redirect(Session::get('url.intended'))->with('status','You are Logged in as customer!');
        }
        //return redirect()->route('home.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function remove(Request $request){
        //dd($request);
        Cart::remove($request->id);
        return redirect()->route('cart.list')->with('alert_msg', 'Item is removed!');
    }
    public function update(Request $request){
        //retry($request->all());
        Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            ));
        return redirect()->route('cart.list')->with('success_msg', 'Cart is Updated!');
    }

    public function cart_update(Request $request)
    {
//        $info = $request->product_id;
//        Cart::update($request->id,
//            array(
//                'quantity' => array(
//                    'relative' => false,
//                    'value' => $request->quantity
//                ),
//            ));
//        return response()->json();
//        if (Auth::guard('mypanel')->user()) {
//            $userID = Auth::guard('mypanel')->user()->id;
//        }else{
//            $userID = $this->default_userID;
//        }
//        $cart_quantity = Cart::session($userID)->getContent()[$request->product_id]->quantity;
//
//        $quantity = $cart_quantity < $request->quantity ? $request->quantity - $cart_quantity : ($request->quantity == $cart_quantity ? 0 :$request->quantity - $cart_quantity);
//
//        Cart::session($userID)->update($request->product_id, array(
//            'quantity' => $quantity,
//        ));
//
//        $each_total_price = Cart::get($request->product_id)->getPriceSum();
//
//        $subTotal = Cart::session($userID)->getSubTotal();
//        $total_quantity = Cart::session($userID)->getTotalQuantity();
//
//        $info = ['each_total_price' => $each_total_price, 'subTotal' => $subTotal, 'total_quantity' => $total_quantity];


    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');

    }

//    public function addtocart(Request $request, $id)
//    {
//
//    	 // assuming you have a Product model with id, name, description & price
//        $data = $request->all();
//       // dd($data);
//        $product = Product::find($id);
//
//        if ($product->productstock->colored || $product->productstock->sized) {
//            if ($request->attribute_pa_size && $request->attribute_pa_color) {
//                $this->add($product, $data);
//                return redirect()->route("cart");
//            }else{
//                $gallery = explode(',', $product->gallery);
//                $similar_products = Product::where('category_id', $product->category_id)->get();
//                Session::flash('error','Please specify colors and sizes');
//                return view("Frontend.simple_product", compact('similar_products','product', 'gallery'));
//            }
//        }else{
//            $this->add($product, $data);
//            return back();
//        }
//    }

//    public function cart()
//    {
//
//        //Session::flush();
//        //dd(count(Cart::session(1233)->getContent()));
//        if (Auth::guard('mypanel')->user()) {
//            $userID = Auth::guard('mypanel')->user()->id;
//        }else{
//            $userID = $this->default_userID;
//        }
//    	//$items = Cart::getContent();
//    	$items = Cart::session($userID)->getContent();
//
//        $all_partners = Brand::all()->toArray();
//        $final = [];
//        for($i=0; $i<count($all_partners); $i+=8)
//        {
//            array_push($final, array_slice($all_partners, $i, 8));
//        }
//    	return view("Frontend.cart", compact('items', 'final'));
//    }

//    public function cart_remove(Request $request, $id)
//    {
//        if (Auth::guard('mypanel')->user()) {
//            $userID = Auth::guard('mypanel')->user()->id;
//        }else{
//            $userID = $this->default_userID;
//        }
//        Cart::session($userID)->remove($id);
//
//        return back();
//    }
//
//    public function cart_update(Request $request)
//    {
//        $info = $request->product_id;
//    	if (Auth::guard('mypanel')->user()) {
//            $userID = Auth::guard('mypanel')->user()->id;
//        }else{
//            $userID = $this->default_userID;
//        }
//        $cart_quantity = Cart::session($userID)->getContent()[$request->product_id]->quantity;
//
//        $quantity = $cart_quantity < $request->quantity ? $request->quantity - $cart_quantity : ($request->quantity == $cart_quantity ? 0 :$request->quantity - $cart_quantity);
//
//    	Cart::session($userID)->update($request->product_id, array(
//            'quantity' => $quantity,
//		));
//
//        $each_total_price = Cart::get($request->product_id)->getPriceSum();
//
//        $subTotal = Cart::session($userID)->getSubTotal();
//        $total_quantity = Cart::session($userID)->getTotalQuantity();
//
//        $info = ['each_total_price' => $each_total_price, 'subTotal' => $subTotal, 'total_quantity' => $total_quantity];
//
//		return response()->json($info);
//    }
//
//
//    public function add($product, $data)
//    {
//
//        $rowId =  uniqid(); // generate a unique() row ID
//        if (Auth::guard('mypanel')->user()) {
//            $userID = Auth::guard('mypanel')->user()->id;
//        }else{
//            $userID = $this->default_userID;
//        }
//
//
//
//        // add the product to cart
//        Cart::session($userID)->add(array(
//            'id' => $product->id,
//            'name' => $product->title,
//            'slug' => $product->slug,
//            'price' => $product->productstock->sales_price,
//            'quantity' => $data['quantity'],
//            'attributes' => array('sized' => $data['attribute_pa_size'], 'colored' => $data['attribute_pa_color']),
//            'associatedModel' => $product,
//        ));
//    }


}
