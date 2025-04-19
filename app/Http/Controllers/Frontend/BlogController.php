<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(10);
        $recents = Blog::orderBy('id','DESC')->limit(5)->get();
        return view("Frontend.Blog.blog_full_width_list", compact('blogs','recents'));
    }

    public function details($slug=NULL)
    {
        $value = Blog::where('slug',$slug)->first();
        $recents = Blog::orderBy('id','DESC')->limit(5)->get();
        return view("Frontend.Blog.details", compact('value','recents'));
    }
}
