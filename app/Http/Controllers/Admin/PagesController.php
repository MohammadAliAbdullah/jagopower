<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view("Admin.Pages.index", compact("pages"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Pages.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $data = $request->all();
        if($file=$request->file('images')){
            $img=preg_replace('/\s+/', '-','thumb.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/page/');
            $img = Image::make($file->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $page['thumb']=$names;
        }
        if($file=$request->file('images')){
            $img=preg_replace('/\s+/', '-','images.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/page/');
            $img = Image::make($file->path());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $page['images']=$names;
        }
        if($file=$request->file('background')){
            $img=preg_replace('/\s+/', '-','page.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/');
            $img = Image::make($file->path());
            $img->resize(1300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $page['background']=$names;
        }
        $page['title'] = $data['title'];
        $page['slug'] = $this->createSlug($data['title']);
        $page['status'] = $data['status'];
        $page['content'] = $data['content'];
        /// SEO meta table
        $page['meta_title'] = $data['meta_title'];
        $page['meta_keyword'] = $data['meta_keyword'];
        $page['meta_description'] = $data['meta_description'];

        Page::create($page);
        Session::flash('status','Your page has been sucessfully add');
        return redirect()->route('madmin.pages.index');
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
        $page = Page::findOrFail($id);
        return view("Admin.Pages.edit", compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $data = $request->all();

        $page_to_update = Page::findOrFail($id);
        $seometa_to_update = Page::findOrFail($id)->seometa;

        $page['title'] = $data['title'];
        if($data['title']==$page_to_update->title){
            $page['slug']=$page_to_update->slug;
        }else{
            $page['slug']=$this->createSlug($data['title']);
        }

        $page['status'] = $data['status'];
        $page['content'] = $data['content'];



        if ($request->has('images')) {
            //thumb
            $thumb_file = $request->images;
            $thumb = Image::make($thumb_file->getRealPath())->resize(300, 300,function ($constraint){
                $constraint->aspectRatio();
            });

            $thumb_dest = storage_path( 'admin/images/pages/thumb/' );
            $page['thumb'] = time() . '.'.$request->images->clientExtension();
            $thumb->save( $thumb_dest.$page['thumb'] );

            //Image
            $page['images'] = time() . '.'.$request->images->clientExtension();
            $image_file = $request->images;
            $image_dest = storage_path( 'admin/images/pages' );
            $image_file->move( $image_dest, $page['images'] );
        }
        if($file=$request->file('background')){
            $img=preg_replace('/\s+/', '-','page.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/');
            $img = Image::make($file->path());
            $img->resize(1300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $page['background']=$names;
        }

        /// SEO meta table
        $page['meta_title'] = $data['meta_title'];
        $page['meta_keyword'] = $data['meta_keyword'];
        $page['meta_description'] = $data['meta_description'];

        $page_to_update->update($page);
        //$seometa_to_update->update($seo_meta);

        Session::flash('status','Your page has been sucessfully updated');
        return redirect()->route('madmin.pages.index');
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
        return Page::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
