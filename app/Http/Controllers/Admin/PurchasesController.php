<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Atribute;
use App\Models\Supplier;
use App\Models\ProductStock;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Auth;
use Illuminate\Support\Facades\Session;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_sku_item(Request $request)
    {
        $arry = [];
        $products = Product::where('title','LIKE','%'.$request->search_term.'%')->get();
        foreach ($products as $value) {
            array_push($arry, ['sku' => $value->sku, 'value' => $value->title]);
        }
        return response()->json($arry);
    }

    public function get_price(Request $request)
    {
        $price = Product::where('title', $request->search_term)->value("sales_price");
        //$price = ProductStock::where('product_id', $products->id)->value("sales_price");
        return response()->json($price);
    }
    // get get_supplier

    public function get_supplier(Request $request)
    {
        $arry = [];
        $Supplier = Supplier::where('company_name','LIKE','%'.$request->search_term.'%')->orWhere('phone','LIKE','%'.$request->search_term.'%')->orWhere('name','LIKE','%'.$request->search_term.'%')->get();
        foreach ($Supplier as $value) {
            array_push($arry, ['company_name' => $value->company_name]);
        }
        return response()->json($arry);
    }


    public function index()
    {
        $purchases = Purchase::paginate(10);
        return view('Admin.Purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Atribute::where('parent_id',18)->get();
        $sizes = Atribute::where('parent_id',19)->get();
        $purchase_number = "PO".time();
        $challan_number = "CL".time();
        $suppliers=Supplier::get()->pluck('company_name','id')->toArray();
        return view("Admin.Purchases.add", compact('colors', 'sizes', 'purchase_number', 'challan_number', 'suppliers'));
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
        for ($i=0; $i < count($data['item']); $i++) {

            $sku = Product::where('title', $data['item'][$i])->value('sku');
            // Update product_stock
            $product_stock['sku'] = $sku;
            $product_stock['sized'] = $data['sized'][$i];
            $product_stock['colored'] = $data['colored'][$i];
            $product_stock['purchase_qty'] = $data['qty'][$i];
            $product_stock['ragular_price'] = $data['purchase_price'][$i];
            $product_stock['purchase_price'] = $data['purchase_price'][$i];
            $product_stock['sales_price'] = $data['sales_price'][$i];
            $old_stock_info = ProductStock::where('sku', $product_stock['sku'])->first();

            if (!empty($old_stock_info->stock_qty)) {
                $product_stock['stock_qty'] = $old_stock_info->stock_qty + $product_stock['purchase_qty'];
                $old_stock_info->update($product_stock);
            }else{
                $product_stock['stock_qty'] = $data['qty'][$i];
                ProductStock::create($product_stock);
            }

            // insert to purchases_details table
            $purchases_details['po_no'] = $request->po_no;
            $purchases_details['sku'] = $sku;
            $purchases_details['colored'] = $data['colored'][$i];
            $purchases_details['sized'] = $data['sized'][$i];
            $purchases_details['purchase_price'] = $data['purchase_price'][$i];
            $purchases_details['sales_price'] = $data['sales_price'][$i];
            $purchases_details['qty'] = $data['qty'][$i];
            $purchases_details['total'] = $data['total'][$i];
            PurchaseDetails::create($purchases_details);
        }
       // $supplier = Supplier::where('company_name', $request->suppliers_id)->first();
        $purchase['po_no'] = $request->po_no;
        $purchase['challan_no'] = $request->challan_no;
        $purchase['suppliers_id'] = $request->suppliers_id;
        $purchase['recevier_id'] =  Auth::guard('madmin')->user()->id;
        $purchase['shipping_cost'] =  $request->shipping_cost;
        $purchase['laber_cost'] =  $request->laber_cost;
        $purchase['discount'] =  $request->discount;
        $purchase['sub_total'] =  $request->sub_total;
        $purchase['total_amount'] =  ($request->sub_total + $request->shipping_cost + $request->laber_cost ) - $request->discount;
        $purchase['order_date'] =  $request->order_date;
        $purchase['received_date'] =  $request->received_date;
        $purchase['note'] =  $request->note;
        $purchase['status'] =  $request->status;

        Purchase::create($purchase);

        Session::flash('status','Your purchase has been sucessfully add');
        return redirect()->route('madmin.purchases.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::where('po_no',$id)->first();
        $supplier = Supplier::findOrFail($purchase->suppliers_id);
        //dd($supplier);
        $purchases_details = PurchaseDetails::where('po_no', $purchase->po_no)->get();
        return view('Admin.Purchases.show', compact('purchase', 'supplier', 'purchases_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $purchases_details = PurchaseDetails::where('po_no', $purchase->po_no)->get();
        $supplier = Supplier::findOrFail($purchase->suppliers_id);

        $colors = Atribute::where('parent_id',18)->get();
        $sizes = Atribute::where('parent_id',19)->get();
        return view('Admin.Purchases.edit', compact('purchase', 'supplier', 'purchases_details', 'colors', 'sizes'));
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
        $purchase = Purchase::findOrFail($id);
        //dd($data['item']);
        PurchaseDetails::where('po_no', $purchase->po_no)->delete();
        for($i = 0; $i < count($data['item']); $i++)
        {
            $sku = Product::where('title', $data['item'][$i])->value('sku');

            // Update product_stock
            $product_stock['sku'] = $sku;
            $product_stock['sized'] = $data['sized'][$i];
            $product_stock['colored'] = $data['colored'][$i];
            $product_stock['purchase_qty'] = $data['qty'][$i];
            $product_stock['ragular_price'] = $data['purchase_price'][$i];
            $product_stock['purchase_price'] = $data['purchase_price'][$i];
            $product_stock['sales_price'] = $data['sales_price'][$i];
            $old_stock_info = ProductStock::where('sku', $product_stock['sku'])->first();

            if (!empty($old_stock_info->stock_qty)) {
                $product_stock['stock_qty'] = $old_stock_info->stock_qty + $product_stock['purchase_qty'];
                $old_stock_info->update($product_stock);
            }

            // update product_details
            $p_details['po_no'] = $data['po_no'];
            $p_details['sku'] = $sku;
            $p_details['colored'] = $data['colored'][$i];
            $p_details['sized'] = $data['sized'][$i];
            $p_details['purchase_price'] = $data['purchase_price'][$i];
            $p_details['sales_price'] = $data['sales_price'][$i];
            $p_details['qty'] = $data['qty'][$i];
            $p_details['total'] = $data['total'][$i];
            PurchaseDetails::create($p_details);

        }


        //update Purchase model final
        $supplier = Supplier::where('company_name', $request->suppliers_id)->first();
        $update_purchase['po_no'] = $data['po_no'];
        $update_purchase['challan_no'] = $data['challan_no'];
        $update_purchase['suppliers_id'] = $supplier->id;
        $update_purchase['recevier_id'] = Auth::guard('madmin')->user()->id;
        $update_purchase['shipping_cost'] = $data['shipping_cost'];
        $update_purchase['laber_cost'] = $data['laber_cost'];
        $update_purchase['discount'] = $data['discount'];
        $update_purchase['sub_total'] = $data['sub_total'];
        $update_purchase['total_amount'] = ($request->sub_total + $request->shipping_cost + $request->laber_cost ) - $request->discount;
        $update_purchase['order_date'] = $data['order_date'];
        $update_purchase['received_date'] = $data['received_date'];
        $update_purchase['note'] = $data['note'];
        $update_purchase['status'] = $data['status'];
        $purchase->update($update_purchase);

        Session::flash('status','Your purchase has been sucessfully updated!');
        return redirect()->route('madmin.purchases.index');

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
