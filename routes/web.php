<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function() {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    return redirect()->back();
});
// Front end routes
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home.index');
Route::get('/today-offer', [App\Http\Controllers\Frontend\HomeController::class, 'today_offer'])->name('today.offer');
Route::get('/newarrival', [App\Http\Controllers\Frontend\CampaignController::class, 'newarrival'])->name('new.arrival');
Route::get('/upcomming', [App\Http\Controllers\Frontend\CampaignController::class, 'upcomming'])->name('up.comming');
Route::get('/campaign', [App\Http\Controllers\Frontend\CampaignController::class, 'campaign'])->name('campaign.index');
Route::get('/campaigns/{slug}', [App\Http\Controllers\Frontend\CampaignController::class, 'campaigns'])->name('campaign.slug');
Route::get('/hotoffer', [App\Http\Controllers\Frontend\CampaignController::class, 'hotoffer'])->name('hotoffer.index');
//Route::get('/login', [App\Http\Controllers\Frontend\HomeController::class, 'login'])->name('login');
//Route::get('/register', [App\Http\Controllers\Frontend\HomeController::class, 'register'])->name('register');
Route::get('/category/{slug}', [App\Http\Controllers\Frontend\HomeController::class, 'shop_by_category'])->name('category');
Route::get('/shops/{category}/{brand}/', [App\Http\Controllers\Frontend\HomeController::class, 'shop_by_shop'])->name('shops');
Route::get('/collection/{category}/{value}/', [App\Http\Controllers\Frontend\HomeController::class, 'collection'])->name('collection');
Route::get('/price/{category}/{slug}', [App\Http\Controllers\Frontend\HomeController::class, 'price'])->name('price');
Route::get('/brands/{slug}', [App\Http\Controllers\Frontend\HomeController::class, 'shop_by_brand'])->name('brands');
Route::post('/shopfilters', [App\Http\Controllers\Frontend\HomeController::class, 'shopfilters'])->name('shop.filters');
Route::get('/shop', [App\Http\Controllers\Frontend\PagesController::class, 'shop'])->name('shop');
Route::post('/shopfilter', [App\Http\Controllers\Frontend\PagesController::class, 'shopfilter'])->name('shop.filter');

//blog
Route::get('/blog', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog.index');
Route::get('/blogs/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'details'])->name('blog.details');

Route::get('/brands/{slug}', [App\Http\Controllers\Frontend\HomeController::class, 'shop_by_brand'])->name('brands');
Route::get('/deals', [App\Http\Controllers\Frontend\PagesController::class, 'deals'])->name('deals');
Route::get('/about-us', [App\Http\Controllers\Frontend\PagesController::class, 'about_us'])->name('about_us');
Route::resource('/complains', 'App\Http\Controllers\Frontend\ComplainController');
Route::get('/contact-us', [App\Http\Controllers\Frontend\PagesController::class, 'contact_us'])->name('contact_us');
Route::get('/brand', [App\Http\Controllers\Frontend\PagesController::class, 'brand'])->name('brand');
Route::get('/warranty-policy', [App\Http\Controllers\Frontend\PagesController::class, 'warranty_policy'])->name('warranty_policy');
Route::get('/terms-conditions', [App\Http\Controllers\Frontend\PagesController::class, 'trams'])->name('trams');
Route::get('/privacy-policy', [App\Http\Controllers\Frontend\PagesController::class, 'privacy'])->name('privacy');
Route::get('/product/{id}', [App\Http\Controllers\Frontend\PagesController::class, 'product_details'])->name('product_details');
Route::get('/quick-view-product/{id}', [App\Http\Controllers\Frontend\PagesController::class, 'product_quick_view_details'])->name('product_quick_view_details');
Route::post('/review', [App\Http\Controllers\Frontend\PagesController::class, 'review_store'])->name('review_store');
Route::get('/track', [App\Http\Controllers\Frontend\PagesController::class, 'track'])->name('track');
Route::post('/search', [App\Http\Controllers\Frontend\HomeController::class, 'search'])->name('search');
//Route::get('/shop', [App\Http\Controllers\Frontend\HomeController::class, 'shop'])->name('shop');
//VRF
Route::get('/vrf', [App\Http\Controllers\Frontend\VrfController::class, 'index'])->name('vrf');
//Checkout
Route::get('/areas', [App\Http\Controllers\Frontend\Checkoutscontroller::class, 'areas'])->name('areas');
Route::get('/checkout', [App\Http\Controllers\Frontend\Checkoutscontroller::class, 'checkout'])->name('checkout');
Route::post('/checkout-Store', [App\Http\Controllers\Frontend\Checkoutscontroller::class, 'checkout_store'])->name('checkout_store');
Route::post('/transaction_fee', [App\Http\Controllers\Frontend\Checkoutscontroller::class, 'transaction_fee'])->name('transaction_fee');
Route::post('/coupon', [App\Http\Controllers\Frontend\Checkoutscontroller::class, 'coupon'])->name('coupon');

//add to cart
Route::post('/add', [App\Http\Controllers\Frontend\CartsController::class, 'add'])->name('cart.Store');
Route::get('/cart', [App\Http\Controllers\Frontend\CartsController::class, 'cart'])->name('cart.list');
Route::post('/update', [App\Http\Controllers\Frontend\CartsController::class, 'update'])->name('update.cart');
//Route::post('/remove', [App\Http\Controllers\Frontend\CartsController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [App\Http\Controllers\Frontend\CartsController::class, 'clear'])->name('cart.clear');
//Route::get('/add-to-cart/{id}', [App\Http\Controllers\Frontend\CartsController::class, 'addtocart'])->name('addtocart');
//Route::post('/cart-update/', [App\Http\Controllers\Frontend\CartsController::class, 'cart_update'])->name('cart_update');
//Route::get('/cart', [App\Http\Controllers\Frontend\CartsController::class, 'cart'])->name('cart');
Route::get('/remove/{id}', [App\Http\Controllers\Frontend\CartsController::class, 'remove'])->name('cart.remove');

// SSLCOMMERZ Start
//Route::get('/example1', [App\Http\Controllers\SslCommerzPaymentController::class, 'exampleEasyCheckout']);
//Route::get('/example2', [App\Http\Controllers\SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [App\Http\Controllers\Mypanel\OrderController::class, 'store']);
//Route::post('/pay-via-ajax', [App\Http\Controllers\SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [App\Http\Controllers\SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [App\Http\Controllers\SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [App\Http\Controllers\SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [App\Http\Controllers\SslCommerzPaymentController::class, 'ipn']);
//Page
Route::get('/faq', [App\Http\Controllers\Frontend\PagesController::class, 'faq'])->name('faq');
Route::get('/about-us', [App\Http\Controllers\Frontend\PagesController::class, 'about_us'])->name('about.us');
Route::get('/contact-us', [App\Http\Controllers\Frontend\PagesController::class, 'contact_us'])->name('contact.us');
Route::get('/page/{slug}', [App\Http\Controllers\Frontend\PagesController::class, 'page']);
Route::resource('/newsletter','\App\Http\Controllers\Frontend\NewsletterController');

//SSLCOMMERZ END
Route::get('/login',[App\Http\Controllers\Mypanel\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::get('/registration',[App\Http\Controllers\Mypanel\Auth\RegisterController::class, 'showLoginForm'])->name('register.user');

Route::prefix('/mypanel')->name('mypanel.')->namespace('Mypanel')->group(function(){
    Route::namespace('Auth')->group(function(){
        //Login Routes
        //Route::get('/userpanel',[App\Http\Controllers\Mypanel\UserController::class, 'index'])->name('index');
        Route::post('/login',[App\Http\Controllers\Mypanel\Auth\LoginController::class, 'login'])->name("loginuser");
        Route::post('/register',[App\Http\Controllers\Mypanel\Auth\RegisterController::class, 'create'])->name('register_user');
        Route::get('/logout',[App\Http\Controllers\Mypanel\Auth\LoginController::class, 'logout'])->name('elogout');
    });
    Route::group(['middleware'=>'mypanel'], function () {
        Route::get('/',[App\Http\Controllers\Mypanel\Deshboardcontroller::class, 'index'])->name('users');
        Route::resource('/morder','\App\Http\Controllers\Mypanel\OrderController');
        Route::get('/invoice/{invoice_no}', [App\Http\Controllers\Mypanel\OrderController::class, 'invoice'])->name('minvoice.index');
        Route::resource('/mreview','\App\Http\Controllers\Mypanel\ReviewController');
        Route::resource('/maddress','\App\Http\Controllers\Mypanel\AddressController');
        Route::resource('/mwallet','\App\Http\Controllers\Mypanel\WalletController');
        Route::resource('/profile','\App\Http\Controllers\Mypanel\UserController');
        Route::resource('/password','\App\Http\Controllers\Mypanel\PasswordController');
    });
});

//admin panel
Route::get('/madmin/dashboard',[App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
//Auth::routes();
Route::prefix('/madmin')->name('madmin.')->namespace('Madmin')->group(function(){
    Route::namespace('Auth')->group(function(){
        //Login Routes
        Route::get('/',[App\Http\Controllers\Admin\AdminController::class, 'index']);
        Route::get('/login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
        Route::post('/logout',[App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');
    });
    Route::group(['middleware'=>'madmin'], function () {
        Route::get('/users',[App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
        Route::resource('/adminmenu','\App\Http\Controllers\Admin\MenuController');
        Route::resource('/adminuser','\App\Http\Controllers\Admin\UserController');
        //Product
        Route::resource('/units','\App\Http\Controllers\Admin\UnitsController');
        Route::resource('/attributes','\App\Http\Controllers\Admin\AttributesController');
        Route::resource('/brands','\App\Http\Controllers\Admin\BrandsController');
        Route::resource('/categories','\App\Http\Controllers\Admin\CategoriesController');
        Route::get('/spacial', [App\Http\Controllers\Admin\CategoriesController::class, 'spacial'])->name('spacial.index');
        Route::get('/regular', [App\Http\Controllers\Admin\CategoriesController::class, 'regular'])->name('regular.index');
        Route::post('/change_sub_category', [App\Http\Controllers\Admin\ProductsController::class, 'change_sub_category'])->name('change_sub_category');
        Route::get('/tags', [App\Http\Controllers\Admin\ProductsController::class, 'tags'])->name('tags');
        Route::resource('/products','\App\Http\Controllers\Admin\ProductsController');
        Route::resource('/bercode','\App\Http\Controllers\Admin\BercodeController');
        Route::get('/autocompleteproduct',[App\Http\Controllers\Admin\BercodeController::class, 'autocompleteproduct'])->name('autocomplete.product');

        Route::resource('/purchases','\App\Http\Controllers\Admin\PurchasesController');
        Route::post('/get_sku_item/data', [App\Http\Controllers\Admin\PurchasesController::class, 'get_sku_item'])->name('get_sku_item');
        Route::post('/get_price', [App\Http\Controllers\Admin\PurchasesController::class, 'get_price'])->name('get_price');
        Route::post('/get_supplier/data', [App\Http\Controllers\Admin\PurchasesController::class, 'get_supplier'])->name('get_supplier');
        Route::resource('/suppliers','\App\Http\Controllers\Admin\SuppliersController');

        Route::get('/stock',[App\Http\Controllers\Admin\StockController::class, 'index'])->name('stock.index');
        Route::get('/stock/low',[App\Http\Controllers\Admin\StockController::class, 'stock_low'])->name('stock.low');
        Route::get('/stock/sold',[App\Http\Controllers\Admin\StockController::class, 'stock_sold'])->name('stock.sold');
        Route::get('/adjustment',[App\Http\Controllers\Admin\StockController::class, 'adjustment'])->name('stock.adjustment');
        Route::get('/adjustment/add',[App\Http\Controllers\Admin\StockController::class, 'adjustment_add'])->name('adjustment.add');
        Route::post('/adjustment/sku',[App\Http\Controllers\Admin\StockController::class, 'get_adjustment_sku'])->name('get_adjustment_sku');
        Route::post('/adjustment/qty',[App\Http\Controllers\Admin\StockController::class, 'get_adjustment_qty'])->name('get_adjustment_qty');
        Route::post('/adjustment/Store',[App\Http\Controllers\Admin\StockController::class, 'store'])->name('adjustment.Store');
        Route::get('/adjustment/edit/{id}',[App\Http\Controllers\Admin\StockController::class, 'edit'])->name('adjustment.edit');
        Route::post('/adjustment/store/{id}',[App\Http\Controllers\Admin\StockController::class, 'update'])->name('adjustment.update');

        Route::resource('/slides','\App\Http\Controllers\Admin\SlidesController');
        Route::resource('/blogs','\App\Http\Controllers\Admin\BlogsController');
        Route::resource('/faqs','\App\Http\Controllers\Admin\FaqsController');
        Route::resource('/pages','\App\Http\Controllers\Admin\PagesController');
        Route::resource('/banners','\App\Http\Controllers\Admin\BannersController');
        Route::resource('/vouchers','\App\Http\Controllers\Admin\VouchersController');
        Route::resource('/flashdealadmin','\App\Http\Controllers\Admin\FlashdealController');
        Route::post('/get_product_id/id', [App\Http\Controllers\Admin\VouchersController::class, 'get_product_id'])->name('get_product_id');
        Route::post('/get_voucher_product', [App\Http\Controllers\Admin\VouchersController::class, 'get_voucher_product'])->name('get_voucher_product');
        Route::resource('/discounts','\App\Http\Controllers\Admin\DiscountsController');
        Route::post('get_discount_product_id', [App\Http\Controllers\Admin\DiscountsController::class, 'get_discount_product_id'])->name('get_discount_product_id');
        Route::resource('/testimonials','\App\Http\Controllers\Admin\TestimonialsController');
        Route::resource('/couriers','\App\Http\Controllers\Admin\CouriersController');
        //Setting
        Route::resource('/paymentgetway', '\App\Http\Controllers\Admin\Setting\PaymentController');
        Route::resource('/contactinfo', '\App\Http\Controllers\Admin\Setting\ContactInfoController');
        Route::resource('/logofavs', '\App\Http\Controllers\Admin\Setting\LogoFavsController');
        Route::resource('/contacts', '\App\Http\Controllers\Admin\Setting\ContactInfoController');
        Route::resource('/seoconfigs', '\App\Http\Controllers\Admin\Setting\SeoConfigsController');
        Route::resource('/socialmedia', '\App\Http\Controllers\Admin\Setting\SocialMediaController');

        Route::resource('/aboutadmin','\App\Http\Controllers\Admin\AboutController');
        Route::resource('/customeradmin','\App\Http\Controllers\Admin\CustomerController');
        Route::resource('/newsletteradmin','\App\Http\Controllers\Admin\NewsletterController');
        Route::resource('/local-sale','\App\Http\Controllers\Admin\LocalSalesController');
        Route::get('/reviews/', [App\Http\Controllers\Frontend\PagesController::class, 'review_index'])->name('review_index');
        Route::get('/reviews/reply/{id}', [App\Http\Controllers\Frontend\PagesController::class, 'review_reply'])->name('review_reply');
        Route::post('/reply-Store/{review_id}/{customer_id}/{admin_id}', [App\Http\Controllers\Frontend\PagesController::class, 'reply_store'])->name('reply_store');
        //Order All
        Route::resource('/orderadmin', '\App\Http\Controllers\Admin\OrderController');
        Route::get('/invoicea4/{invoice_no}', [App\Http\Controllers\Admin\OrderController::class, 'invoicea4'])->name('invoicea4.index');
        Route::get('/chalan/{invoice_no}', [App\Http\Controllers\Admin\OrderController::class, 'chalan'])->name('chalan.index');
        Route::get('/invoicea4photo/{invoice_no}', [App\Http\Controllers\Admin\OrderController::class, 'invoicea4photo'])->name('invoicea4photo.index');
        Route::get('/pending', [App\Http\Controllers\Admin\OrderController::class, 'pending'])->name('orders.pending');
        Route::get('/complete', [App\Http\Controllers\Admin\OrderController::class, 'complete'])->name('orders.complete');
        Route::get('/due', [App\Http\Controllers\Admin\OrderController::class, 'due'])->name('orders.due');
        Route::get('/paid', [App\Http\Controllers\Admin\OrderController::class, 'paid'])->name('orders.paid');
        Route::resource('/orderreturn', '\App\Http\Controllers\Admin\OrderReturnController');
        // Complain Box
        Route::resource('/complainadmin', '\App\Http\Controllers\Admin\ComplainBoxController');
        Route::get('/pendings', [App\Http\Controllers\Admin\ComplainBoxController::class, 'pending'])->name('complainadmin.pendings');
        Route::get('/completes', [App\Http\Controllers\Admin\ComplainBoxController::class, 'complete'])->name('complainadmin.completes');
        //Servicing Part
        Route::resource('/servicing', '\App\Http\Controllers\Admin\ServicingController');
        //Store Beta
        Route::resource('/store', '\App\Http\Controllers\Admin\StoreController');
        Route::resource('/tutorial', '\App\Http\Controllers\Admin\TutorialController');
        //Marketing
        Route::resource('/smscampaign','\App\Http\Controllers\Admin\SMS\SMSCampaignController');
        Route::resource('/smstemplete','\App\Http\Controllers\Admin\SMS\SMSTempleteController');
        Route::resource('/smslog','\App\Http\Controllers\Admin\SMS\SMSLogController');
        Route::get('/smssends/{id}', '\App\Http\Controllers\Admin\SMS\SmsSendController@sendSMS');
        //Reports
        Route::get('salesreports','\App\Http\Controllers\Admin\ReportController@sales')->name('sales.reports');
        Route::get('stockreports','\App\Http\Controllers\Admin\ReportController@stock')->name('stock.reports');
    });
});
//Auth::routes();


