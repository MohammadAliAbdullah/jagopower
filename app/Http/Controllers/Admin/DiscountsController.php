<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('id','DESC')->paginate(10);
        return view("Admin.Discounts.index", compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Discounts.add");
    }

    public function get_discount_product_id(Request $request)
    {
        $arry = [];
        $products = Product::where('title','LIKE','%'.$request->search_term.'%')->get();
        foreach ($products as $value) {
            array_push($arry, ['id' => $value->id, 'title' => $value->title]);
        }
        return response()->json($arry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $data = $request->all();
        $id_array = [];
        if (array_key_exists('product_id', $data)) {
            for ($i = 0; $i < count($data['product_id']); $i++) {
                $id = Product::where('title', $data['product_id'][$i])->value('id');
                array_push($id_array, $id);
            }
            $data['product_id'] = implode(',', $id_array);
        }
        //$data['product_id'] = implode(',', $data['product_id']);
        //dd($data);
        Discount::create($data);
        Session::flash('status','Your discount has been sucessfully add');
        return redirect()->route('madmin.discounts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discount = Discount::findOrFail($id);
        $product_id = explode(',', $discount->product_id);
        //$products = Product::where("id", $discount->)
        return view('Admin.Discounts.show', compact("discount", 'product_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $product_ids = explode(',', $discount['product_id']);
        return view('Admin.Discounts.edit', compact("discount", 'product_ids'));
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
        $discount = Discount::findOrFail($id);
        $data = $request->all();
        $data['product_id'] = implode(',', $data['product_id']);
        $discount->update($data);
        Session::flash('status','Your discount has been sucessfully updated!');
        return redirect()->route('madmin.discounts.index');
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
