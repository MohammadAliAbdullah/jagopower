<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\PaymentGetway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values=PaymentGetway::paginate(20);
        return view('Admin.Setting.Payment.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Setting.Payment.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($file=$request->file('images')){
            $img=preg_replace('/\s+/', '-','images.'. $file->extension());
            $names=time().$img;
            $destinationPath = public_path('payment/');
            $img = Image::make($file->path());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $data['images']=$names;
        }
        $data['name']=$request->name;
        $data['slug']=$this->createSlug($request->name);
        $data['account_no']=$request->account_no;
        $data['content']=$request->contents;
        $data['key']=$request->key;
        $data['secret']=$request->secret;
        $data['inst']=$request->inst;
        $data['type']=$request->type;
        $data['status']=$request->status;
        PaymentGetway::create($data);
        Session::flash('status','Your Payment Getway has been sucessfully add');
        return redirect()->route('madmin.paymentgetway.index');
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
        $show=PaymentGetway::findOrFail($id);
        return view('Admin.Setting.Payment.edit', compact('show'));
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
        $show=PaymentGetway::findOrFail($id);
        if($file=$request->file('images')){
            $img=preg_replace('/\s+/', '-','images.'. $file->extension());
            $names=time().$img;
            $destinationPath = public_path('payment/');
            $img = Image::make($file->path());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $data['images']=$names;
        }
        $data['name']=$request->name;
        if($data['name']==$show->title){
            $category['slug']=$show->slug;
        }else{
            $data['slug']=$this->createSlug($request->name);
        }
        $data['account_no']=$request->account_no;
        $data['content']=$request->contents;
        $data['key']=$request->key;
        $data['secret']=$request->secret;
        $data['inst']=$request->inst;
        $data['type']=$request->type;
        $data['status']=$request->status;
        $show->update($data);
        Session::flash('status','Your Payment Getway has been sucessfully Update!!');
        return redirect()->route('madmin.paymentgetway.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show=PaymentGetway::findOrFail($id);
        $show->delete();
        Session::flash('status','Your Payment Getway has been sucessfully Delete!!');
        return redirect()->route('madmin.paymentgetway.index');
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return PaymentGetway::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
