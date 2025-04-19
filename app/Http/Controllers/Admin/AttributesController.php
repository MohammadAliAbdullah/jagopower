<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AtributeRequest;
use Illuminate\Http\Request;

use App\Models\Atribute;
use Illuminate\Support\Facades\Session;


class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes=Atribute::paginate(10);
        return view('Admin.Attribute.index',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes=Atribute::where('parent_id',0)->get()->pluck('name','id')->toArray();
        return view('Admin.Attribute.add', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtributeRequest $request)
    {
        $data = $request->all();
        $udata['name'] = $request->name;
        $udata['slug']=$this->createSlug($data['name']);
        $udata['value'] = $request->value;
        $udata['parent_id'] = $request->parent_id;
        if($file=$request->file('image')){
            $img=preg_replace('/\s+/', '-','logo.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/attribute/');
            $img = Image::make($file->path());
            $img->resize(50, 50, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $user_data['images']=$names;
        }
        ///$udata['images'] = time() . '.'.$request->image->clientExtension();
        //dd(storage_path('public'));
        //$file = $request->image;
//        $destinationPath = storage_path( 'admin/images/attributes' );
//        $file->move( $destinationPath, $udata['images'] );

        Atribute::create($udata);
        Session::flash('status','Your attribute has been sucessfully add');
        return redirect('/madmin/attributes');

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
        $parents=Atribute::where('parent_id',0)->get()->pluck('name','id')->toArray();
        $attribute=Atribute::findOrFail($id);
        return view('Admin.Attribute.edit',compact('parents','attribute'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AtributeRequest $request, $id)
    {
        $attribute=Atribute::findOrFail($id);
        $data = $request->all();
        $udata['name'] = $request->name;
        if($data['name']==$attribute->name){
            $category['slug']=$attribute->slug;
        }else{
            $category['slug']=$this->createSlug($data['name']);
        }
        $udata['value'] = $request->value;
        $udata['parent_id'] = $request->parent_id;
        if($file=$request->file('image')){
            $img=preg_replace('/\s+/', '-','image.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/attribute/');
            $img = Image::make($file->path());
            $img->resize(50, 50, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $user_data['images']=$names;
        }

        $attribute->update($udata);
        Session::flash('status','Your attribute has been sucessfully updated');
        return redirect('/madmin/attributes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute=Atribute::findOrFail($id);
        $attribute->delete();
        Session::flash('status','Your attribute has been sucessfully delete!!');
        return redirect('/madmin/attributes');
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
        return Atribute::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
