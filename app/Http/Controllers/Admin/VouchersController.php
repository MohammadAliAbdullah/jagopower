<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Voucher;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::paginate(10);
        return view('Admin.Vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Vouchers.add");
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
        //dd($data);
        $id_array = [];
        if (array_key_exists('product_id', $data)) {
            for ($i = 0; $i < count($data['product_id']); $i++) {
                $id = Product::where('title', $data['product_id'][$i])->value('id');
                array_push($id_array, $id);
            }
            $data['product_id'] = implode(',', $id_array);
        }
        

        $data['useges_qty'] = 0;
        Voucher::create($data);
        Session::flash('status','Your voucher has been sucessfully add');
        return redirect()->route('madmin.vouchers.index');

    }

    public function get_product_id(Request $request)
    {
        $arry = [];
        $products = Product::where('title','LIKE','%'.$request->search_term.'%')->get();
        foreach ($products as $value) {
            array_push($arry, ['id' => $value->id, 'title' => $value->title]);
        }
        return response()->json($arry);
    }

    public function get_voucher_product(Request $request)
    {
        $product_id_array = explode(',', $request->search_term);
        $voucher_products = [];
        
        foreach ($product_id_array as $product_id) {
            $products = Product::where('id', $product_id)->first();
            array_push($voucher_products, $products);
        }
        return response()->json($voucher_products);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::findOrFail($id);
        $product_id = explode(',', $voucher->product_id);
        return view('Admin.Vouchers.show', compact("voucher", 'product_id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('Admin.Vouchers.edit', compact("voucher"));
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
        $voucher = Voucher::findOrFail($id);
        $data = $request->all();
        $id_array = [];
        for ($i = 0; $i < count($data['product_id']); $i++) {
            $id = Product::where('title', $data['product_id'][$i])->value('id');
            array_push($id_array, $id);
        }

        $data['product_id'] = implode(',', $id_array);

        $voucher->update($data);
        Session::flash('status','Your voucher has been sucessfully updated');
        return redirect()->route('madmin.vouchers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Voucher::findOrFail($id)->delete();
        Session::flash('status','Your voucher has been sucessfully deleted!');
        return redirect()->route('madmin.vouchers.index');
    }
}
