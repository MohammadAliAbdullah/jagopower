<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Adjustment;
use App\Models\Product;
use App\Models\ProductStock;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{

    public function index()
    {
        $stocks = Product::paginate(10);
        return view("Admin.Stock.index", compact('stocks'));
    }

    
    public function stock_low()
    {
        $stock_low = DB::table('products')
            ->join('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->where('product_stocks.stock_qty', '<', 6)
            ->paginate(10);
        //$stock_low = Product::where('stock_qty', '<', 6)->paginate(10);
        return view('Admin.Stock.low', compact('stock_low'));
    }

    
    public function adjustment(Request $request)
    {
        if ($request->search){
            $product=Product::where('title', 'like', '%' .$request->search. '%')->first();
            $values=ProductStock::where('product_id', $product->id)->paginate(20);
        }else{
            $values=ProductStock::paginate(20);

        }
        return view("Admin.Stock.adjustment", compact('values'));
    }

    public function adjustment_add()
    {
        return view('Admin.Stock.add');
    }

    public function get_adjustment_sku(Request $request)
    {
        $arry = [];
        $products = Product::where('title','LIKE','%'.$request->search_term.'%')->get();
        foreach ($products as $value) {
            array_push($arry, ['sku' => $value->sku, 'title' => $value->title]);
        }

        return response()->json($arry);
    }

    public function get_adjustment_qty(Request $request)
    {
        $qty = ProductStock::where('sku', $request->sku)->value('stock_qty');

        return response()->json($qty);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $stock = ProductStock::where('sku', $request->sku)->first();
        Adjustment::create($data);

        if ($request->type == "In") {
            $product_stock['stock_qty'] = $request->stock_qty + $request->action_qty;
            $stock->update($product_stock);
        }elseif ($request->type == "Out" || $request->type == "Damage") {
            $product_stock['stock_qty'] = $request->stock_qty - $request->action_qty;
            $stock->update($product_stock);
        }

        Session::flash('status','Your adjustment has been sucessfully add');
        return redirect()->route('madmin.stock.adjustment');

    }


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
        $adjustment = ProductStock::findOrFail($id);
        //dd($adjustment->type);
        return view('Admin.Stock.edit', compact('adjustment'));
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
        $adjustment = Adjustment::findOrFail($id);
        $stock = ProductStock::where('sku', $request->sku)->first();
        $data = $request->all();

        if ($request->type == "In") {
            $data['stock_qty'] = $request->stock_qty + $request->action_qty;
            $stock['stock_qty'] = $data['stock_qty'];
        }elseif ($request->type == "Out" || $request->type == "Damage") {
            $data['stock_qty'] = $request->stock_qty - $request->action_qty;
            $stock['stock_qty'] = $data['stock_qty'];
        }

        $stock->update($data);
        $adjustment->update($data);

        Session::flash('status','Your adjustment has been sucessfully updated!');
        return redirect()->route('madmin.stock.adjustment');
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
