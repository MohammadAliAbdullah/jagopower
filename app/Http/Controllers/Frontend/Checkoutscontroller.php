<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Division;
use App\Models\PaymentGetway;
use Illuminate\Http\Request;
use Auth;
use Cart;
use App\Models\Customer;
use App\Models\Voucher;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;


class Checkoutscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function areas(Request $request){
        $sub_cats =City::orderBy('name','ASC')->where('division_id', $request->parent_id)->get()->pluck('name','id')->toArray();
        return response()->json($sub_cats);;
    }

    public function checkout()
    {
        if (Auth::guard('mypanel')->user()) {
            $customer = Auth::guard('mypanel')->user();
            $cartCollection = Cart::getContent();
            $districts=Division::orderBy('name','ASC')->get()->pluck('name','id')->toArray();
            $payments=PaymentGetway::orderBy('id','ASC')->where('status','Active')->get();
            return view("Frontend.checkout", compact('customer', 'cartCollection', 'districts','payments'));
        }else{
            session(['link' => url()->previous()]);
            return redirect()->route('login');
        }
        
    }
    public function transaction_fee(Request $request)
    {
        $district = $request->district;
        $condition1 = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'transaction_fee',
                'type' => 'transaction',
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => '+20',
                'order' => 1
            ));
        $customer = Auth::guard('mypanel')->user();

        if ($district != "Dhaka") {
            
            Cart::session($customer->id)->condition($condition1);
        }elseif ($district == "Dhaka") {
            Cart::session($customer->id)->clearCartConditions($condition1);
        }

        $items = Cart::session($customer->id)->getContent();

        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupon(Request $request)
    {
        $coupon_code = $request->coupon_code;
        $is_used = Coupon::where([['coupon', '=', $coupon_code], ['user_id', '=', Auth::guard('mypanel')->user()->id]])->first();
        $find_coupon = Voucher::where([['code', '=', $coupon_code], ['status', '=', 'Ongoing']])->first();

        if ($find_coupon && ($find_coupon->useges_qty < $find_coupon->voucher_limit) ) {
            $is_shop = $find_coupon->product_id;
            if ($find_coupon->product_id == "Shop") {
                $target = "subtotal";
                
                $this->apply_coupon($is_shop, $find_coupon, $target);
            }else
            {
                # check if cart has product id in $find_coupon variable.
                $target = "subtotal";
                $this->apply_coupon($is_shop, $is_used, $find_coupon, $target);
            }
        }else
        {
            return response()->json('Invalid coupon code !!!'); exit();
            //return response()->json($this->message);
        }
        return response()->json($this->message);
        

    }

    public function apply_coupon($is_shop, $is_used, $find_coupon, $target)
        {
            if ($is_used == null) {
                if ($find_coupon->rewordtype == 'Cashback') 
                {
                    // update user profile to got a cashback....
                }
                else
                {
                    if ($is_shop == "Shop") {
                            $this->coupon_condition = new \Darryldecode\Cart\CartCondition(array(
                            'name' => $find_coupon->name,
                            'type' => $find_coupon->amount_type,
                            'target' => $target, 
                            'value' => -($find_coupon->rewordtype == 'Discount' ? ($find_coupon->amount_type == 'Percentage' ? ($find_coupon->discount_amount * Cart::session(Auth::guard('mypanel')->user()->id)->getSubTotal())/100 : $find_coupon->discount_amount) : 0 ) ,
                            'order' => 1
                        ));
                        Cart::session(Auth::guard('mypanel')->user()->id)->condition($this->coupon_condition); 
                    }else
                    {

                        // lets create first our condition instance
                        $this->item_price = 0;
                        $this->product_id_array = explode(',', $find_coupon->product_id);
                        $this->data_product = Cart::session(Auth::guard('mypanel')->user()->id)->getContent();
                        // now the product to be added on cart
                        for ($i=0; $i < count($this->product_id_array) ; $i++) { 
                                
                            foreach ($this->data_product as $key => $value){
                                if ($this->product_id_array[$i] == $key) {
                                    // idea here is to update $salecondition.value (maybe.)
                                    $this->item_price = $value->price;
                                    $this->product = array(
                                    'price' =>$value->price - ($find_coupon->rewordtype == 'Discount' ? ($find_coupon->amount_type == "Percentage" ? ($find_coupon->discount_amount * $this->item_price)/100 : $find_coupon->discount_amount) : 0 ),
                                    );
                                    Cart::session(Auth::guard('mypanel')->user()->id)->update($value->id, $this->product);
                                }
                            }
                            $this->item_price = 0;   
                        }     
                    }
                }

                //insert user_id and code to Coupon table
                $insert_coupon = [];
                $insert_coupon['user_id'] = Auth::guard('mypanel')->user()->id;
                $insert_coupon['coupon'] = $find_coupon->code;
                Coupon::create($insert_coupon);
                //update voucher table ugase limit
                $c_voucher = Voucher::find($find_coupon->id);
                $voucher_update = [];
                $voucher_update['useges_qty'] = $c_voucher->useges_qty + 1;
                $c_voucher->update($voucher_update);

                $this->message = "Great! Coupon code applied successfuly !";
            }
            else
            {
                $this->message = "Oops! Coupon code already used !";
            }
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/*    public function checkout_store(Request $request)
    {
        $data = json_encode($request->all());
        //dd("here");
        if (Auth::guard('mypanel')->user()) {
            dd("in");
            $userID = Auth::guard('mypanel')->user()->id;
            $items = Cart::session($userID)->getContent();
        }
        

    }*/

}
