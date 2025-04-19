<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function newarrival()
    {
        //Session::flash();
        $products = Product::where('status','Active')->orderBy('id','DESC')->paginate(24);
        return view("Frontend.campaign.new", compact('products'));
    }
    public function upcomming()
    {
        //Session::flash();
        $products = Product::where('status','Active')->orderBy('id','DESC')->paginate(24);
        return view("Frontend.campaign.upcomming", compact('products'));
    }
    public function campaign()
    {
        $today = strtotime(date('Y-m-d H:i:s'));
        //Session::flash();
        $campaigns = FlashDeal::where('status','Active')
                    ->where('start_date', "<=", $today)
                    ->where('end_date', ">", $today)
                    ->orderBy('id','DESC')->paginate(24);
        return view("Frontend.campaign.campaign", compact('campaigns'));
    }
    public function campaigns($slug)
    {
        //Session::flash();
        $deals = FlashDeal::where('slug', $slug)->first();

        if ($deals != null){
            $products = FlashDealProduct::where('flash_deal_id', $deals->id)->paginate(24);
            return view("Frontend.campaign.deals", compact('deals', 'products'));
        }else{
            abort(404);
        }
    }
    public function hotoffer()
    {
        //Session::flash();
        $products = Product::where('status','Active')->orderBy('id','DESC')->paginate(24);
        return view("Frontend.campaign.hotoffer", compact('products'));
    }
}
