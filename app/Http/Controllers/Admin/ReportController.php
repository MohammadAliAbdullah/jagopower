<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request){
        if (isset($request->start) AND isset($request->end)){
           // dd(Carbon::now());
            $orders=Order::whereBetween('created_at', [$request->start, $request->end])
                //->where('created_at', '>=', $request->end)
                ->orderBy('id','DESC')
                ->paginate(10);
            $qty=Order::whereBetween('created_at', [$request->start, $request->end])->count();
            $amount=Order::whereBetween('created_at', [$request->start, $request->end])->sum('total');
        }else{
            $qty=Order::count();
            $amount=Order::sum('total');
            $orders=Order::orderBy('id','DESC')->paginate(10);
        }
        return view('Admin.reports.sales', compact('orders','qty','amount'));
    }
    public function stock(Request $request){
        if (isset($request->start) AND isset($request->end)){
            // dd(Carbon::now());
            $orders=Order::whereBetween('created_at', [$request->start, $request->end])
                //->where('created_at', '>=', $request->end)
                ->orderBy('id','DESC')
                ->paginate(10);
            $qty=Order::whereBetween('created_at', [$request->start, $request->end])->count();
            $amount=Order::whereBetween('created_at', [$request->start, $request->end])->sum('total');
        }else{
            $product=ProductStock::count();
            $category=Category::count();
            $brand=Brand::count();
            $qty=ProductStock::sum('stock_qty');
            $stocks = ProductStock::paginate(10);
        }
        return view('Admin.reports.stock', compact('stocks','product','category','brand','qty'));
    }
}
