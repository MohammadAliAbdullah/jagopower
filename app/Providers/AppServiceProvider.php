<?php

namespace App\Providers;

use App\Models\ContactInfo;
use App\Models\SeoConfig;
use App\Models\SocialMedia;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $category_menus = Category::where('id','!=',12)->where('parent_id', 0)->get();
        view()->share('category_menus', $category_menus);
        $contact_info = ContactInfo::where('id',1)->first();
        view()->share('contact_info', $contact_info);
//        $socials = SocialMedia::orderBy('orders','ASC')->get();
//        view()->share('socials', $socials);
        $seo = SeoConfig::where('id',1)->first();
        view()->share('seo', $seo);
        $tags = Tag::get();
        view()->share('tags', $tags);
        View::composer('Frontend.Layout.header', function ($view) {
            $view->with('cartCount', Cart::getTotalQuantity());
        });
    }
}
