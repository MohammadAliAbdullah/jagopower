<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\SeoMeta;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view("Admin.Blogs.index", compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Blogs.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $data = $request->all();

        $blog['title'] = $data['title'];
        $blog['slug'] = $this->createSlug($data['title']);
        //$blog['slug'] = str_replace(" ","-",$blog['title']);
        $blog['status'] = $data['status'];
        $blog['content'] = $data['content'];
        $blog['writer'] = $data['writer'];
        //thumb
        $thumb_file = $request->images;
        $thumb = Image::make($thumb_file->getRealPath())->resize(300, 300,function ($constraint){
            $constraint->aspectRatio();
        });

        $thumb_dest = public_path( 'images/blogs/thumb/' );
        $blog['thumb'] = time() . '.'.$request->images->clientExtension();
        $thumb->save( $thumb_dest.$blog['thumb'] );

        //Image 
        $blog['images'] = time() . '.'.$request->images->clientExtension();
        $image_file = $request->images;
        $image_dest = public_path( 'images/blogs' );
        $image_file->move( $image_dest, $blog['images'] );

        /// SEO meta table
        $blog['meta_title'] = $data['meta_title'];
        $blog['meta_keyword'] = $data['meta_keyword'];
        $blog['meta_description'] = $data['meta_description'];
        Blog::create($blog);
        Session::flash('status','Your blog has been sucessfully add');
        return redirect()->route('madmin.blogs.index');
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
        $blog = Blog::findOrFail($id);
        return view("Admin.Blogs.edit", compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $data = $request->all();
        $blog_to_update = Blog::findOrFail($id);
        $blog['title'] = $data['title'];

        if($data['title']==$blog_to_update->title){
            $category['slug']=$blog_to_update->slug;
        }else{
            $blog['slug'] = $this->createSlug($data['title']);
        }
        $blog['status'] = $data['status'];
        $blog['content'] = $data['content'];
        $blog['writer'] = $data['writer'];

        if ($request->has('images')) {
            //thumb
            $thumb_file = $request->images;
            $thumb = Image::make($thumb_file->getRealPath())->resize(300, 300,function ($constraint){
                $constraint->aspectRatio();
            });

            $thumb_dest = public_path( 'images/blogs/thumb/' );
            $blog['thumb'] = time() . '.'.$request->images->clientExtension();
            $thumb->save( $thumb_dest.$blog['thumb'] );

            //Image 
            $blog['images'] = time() . '.'.$request->images->clientExtension();
            $image_file = $request->images;
            $image_dest = public_path( 'images/blogs' );
            $image_file->move( $image_dest, $blog['images'] );
        }

        /// SEO meta table
        $blog['meta_title'] = $data['meta_title'];
        $blog['meta_keyword'] = $data['meta_keyword'];
        $blog['meta_description'] = $data['meta_description'];
        $blog_to_update->update($blog);
        Session::flash('status','Your blog has been sucessfully updated');
        return redirect()->route('madmin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Blog::findOrFail($id);
        $category->delete();
        Session::flash('status','Your Blog has been sucessfully deleted!');
        return redirect()->route('madmin.blogs.index');
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
        return Blog::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
