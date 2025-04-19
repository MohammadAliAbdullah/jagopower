<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class FlashdealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flashdeals=FlashDeal::orderBy('id','DESC')->paginate(10);
        return view('Admin.Flashdeal.index', compact('flashdeals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Flashdeal.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rdata=$request->all();
        $daterang=explode(" to ", $request->date);
        //dd($rdata);
        if($file=$request->file('banar')){
            $img=preg_replace('/\s+/', '-','banner.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/campaign/');
            $img = Image::make($file->path());
            $img->resize(1300, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $flash['banner'] = $names;
        }
        $flash['title'] = $rdata['title'];
        $flash['slug']=Str::slug($rdata['title']);
        $flash['start_date'] = strtotime($daterang[0]);
        $flash['end_date'] = strtotime($daterang[1]);
        $flash['background_color'] = $rdata['bgcolor'];
        $flash['text_color'] = $rdata['textcolor'];
        //$flash['featured'] = $rdata['featured'];
        $flash['amount'] = $rdata['amount'];
        $flash['type'] = $rdata['type'];
        $flash['status'] = $rdata['status'];
       // dd($flash);
        $flashid=FlashDeal::create($flash);
//dd($flashid);
        $id_array = [];
        if (array_key_exists('product_id', $rdata)) {
            for ($i = 0; $i < count($rdata['product_id']); $i++) {
                $id = Product::where('title', $rdata['product_id'][$i])->value('id');
                array_push($id_array, $id);
            }
            //$data['product_id'] = implode(',', $id_array);
        //    //dd(count($id_array));
            for($i=0; $i<count($id_array); $i++){
                $flashd['flash_deal_id'] = $flashid->id;
                $flashd['product_id'] = $id_array[$i];
                $flashd['discount'] = $rdata['amount'];
                $flashd['discount_type'] = $rdata['type'];
                //dd($flashd);
                FlashDealProduct::create($flashd);
            }
        }

        //dd(strtotime(date('Y-m-d H:i:s')));
        Session::flash('status','Flash Deal has been sucessfully add');
        return redirect()->route('madmin.flashdealadmin.index');
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
        $flash=FlashDeal::findOrFail($id);
        $product_ids=FlashDealProduct::where('flash_deal_id',$id)->get();
        //dd($product_ids);
        return view('Admin.Flashdeal.edit', compact('flash','product_ids'));
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
        $rdata=$request->all();
        $flash1=FlashDeal::findOrFail($id);
        $daterang=explode(" to ", $request->date);
        //dd($rdata);
        if($file=$request->file('banar')){
            if(file_exists(public_path() . "/images/campaign/" . $flash1->banner)) {
                unlink(public_path() . "/images/campaign/" . $flash1->banner);
            }
            $img=preg_replace('/\s+/', '-','banner.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/campaign/');
            $img = Image::make($file->path());
            $img->resize(1300, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $flash['banner'] = $names;
        }
        $flash['title'] = $rdata['title'];
        $flash['slug']=Str::slug($rdata['title']);
        $flash['start_date'] = strtotime($rdata['start_date1']);
        $flash['end_date'] = strtotime($rdata['end_date1']);
        $flash['background_color'] = $rdata['background_color'];
        $flash['text_color'] = $rdata['text_color'];
        $flash['amount'] = $rdata['amount'];
        $flash['type'] = $rdata['type'];
        //$flash['featured'] = $rdata['featured'];
        $flash['status'] = $rdata['status'];
        //dd($flash);
        $flash1->update($flash);
        $flashd1=FlashDealProduct::where('flash_deal_id',$id)->delete();
//dd($id);
        $id_array = [];
        if (array_key_exists('product_id', $rdata)) {
            for ($i = 0; $i < count($rdata['product_id']); $i++) {
                $ids = Product::where('title', $rdata['product_id'][$i])->value('id');
                array_push($id_array, $ids);
            }
            //$data['product_id'] = implode(',', $id_array);
            //dd($id_array);
            for($i=0; $i<count($id_array); $i++){
                $flashd['flash_deal_id'] = $id;
                $flashd['product_id'] = $id_array[$i];
                $flashd['discount'] = $rdata['amount'];
                $flashd['discount_type'] = $rdata['type'];
                //dd($flashd);
                FlashDealProduct::create($flashd);
            }
        }

        //dd(strtotime(date('Y-m-d H:i:s')));
        Session::flash('status','Flash Deal has been sucessfully Updated!!');
        return redirect()->route('madmin.flashdealadmin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flash=FlashDeal::findOrFail($id);
        if(file_exists(public_path() . "/images/campaign/" . $flash->banner)) {
            unlink(public_path() . "/images/campaign/" . $flash->banner);
        }
        //dd($flashd);
        $flash->delete();
        $flashd=FlashDealProduct::where('flash_deal_id',$id)->delete();
        Session::flash('status','Flash Deal has been sucessfully Delete');
        return redirect()->route('madmin.flashdealadmin.index');
    }
}
