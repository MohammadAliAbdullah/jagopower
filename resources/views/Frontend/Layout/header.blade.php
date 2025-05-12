@php
    $hotline = contacth()->hotline;
    // Remove any non-digit characters and convert to international format
    $cleanHotline = preg_replace('/\D/', '', $hotline);
    $whatsappNumber = '880' . ltrim($cleanHotline, '0');
@endphp
<div class="position-fixed d-flex flex-column align-items-center"
    style="top: 80%; right: 1rem; transform: translateY(-50%); z-index: 1050; width: 5rem;">

    {{-- Cart Button --}}
    {{-- Phone Call Button --}}
    <div class="position-relative mb-3">
        <a href="tel:{{ $hotline }}">
            <button type="button" class="btn btn-dark d-flex align-items-center justify-content-center p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1.003 1.003 0 011.02-.24 11.72 11.72 0 003.68.59c.55 0 1 .45 1 1v3.5a1 1 0 01-1 1C10.07 21 3 13.93 3 5a1 1 0 011-1h3.5c.55 0 1 .45 1 1 0 1.28.2 2.53.59 3.68a1.003 1.003 0 01-.24 1.02l-2.23 2.09z" />
                </svg>
            </button>
        </a>
    </div>

    {{-- WhatsApp Button --}}
    <div class="position-relative mb-3">
        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank">
            <button type="button" class="btn btn-success d-flex align-items-center justify-content-center p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 2.25c-5.376 0-9.75 4.373-9.75 9.75 0 1.716.446 3.397 1.292 4.883L2.25 21.75l5.086-1.266A9.704 9.704 0 0012 21.75c5.376 0 9.75-4.374 9.75-9.75S17.376 2.25 12 2.25zm.007 17.25a7.49 7.49 0 01-3.832-1.062l-.273-.162-3.012.75.77-2.933-.177-.3a7.479 7.479 0 1113.497-1.031 7.49 7.49 0 01-7.06 4.738zm4.03-5.384c-.22-.111-1.293-.637-1.494-.71-.201-.074-.348-.111-.494.111-.148.222-.567.71-.696.857-.129.148-.258.166-.478.056-.222-.111-.936-.344-1.783-1.097-.659-.588-1.103-1.314-1.232-1.535-.13-.222-.014-.342.097-.453.1-.099.222-.258.333-.388.112-.13.149-.222.224-.37.074-.148.037-.277-.019-.388-.057-.111-.494-1.193-.677-1.638-.18-.434-.362-.374-.494-.38a1.233 1.233 0 00-.423-.008c-.146.018-.38.055-.58.277a2.444 2.444 0 00-.76 1.829c0 1.078.781 2.118.89 2.264.111.148 1.536 2.348 3.723 3.186.521.201.926.32 1.242.41.522.166.996.143 1.37.087.418-.062 1.293-.527 1.476-1.036.184-.508.184-.944.129-1.036-.055-.093-.203-.148-.423-.26z" />
                </svg>
            </button>
        </a>
    </div>

    {{-- Messenger Button https://www.facebook.com/profile.php?id=61557392113538 --}}
    <div class="position-relative">
        <a href="https://m.me/61557392113538" target="_blank">
            <button type="button" class="btn btn-info d-flex align-items-center justify-content-center p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 2.25c-5.376 0-9.75 4.373-9.75 9.75 0 1.92.573 3.758 1.65 5.325L2.25 21.75l4.917-1.617A9.699 9.699 0 0012 21.75c5.376 0 9.75-4.374 9.75-9.75S17.376 2.25 12 2.25zm.653 12.516l-2.183-2.321-4.068 2.321 4.743-5.244 2.207 2.321 4.043-2.321-4.742 5.244z" />
                </svg>
            </button>
        </a>
    </div>
</div>

<div class="headtopbg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="headtop">
                    <ul>
                        <li>
                            <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank"
                                class="fw-bold text-white text-decoration-none">
                                <i class="fab fa-whatsapp me-1"></i> {{ $hotline }}
                            </a>
                            {{-- <a href="tel:{{ contacth()->hotline }}"><i class="fas fa-phone"></i> {{ contacth()->hotline }}</a> --}}
                        </li>
                        <li>
                            <a href="mailto:{{ contacth()->email }}"><i class="fas fa-envelope"></i>
                                {{ contacth()->email }}</a>
                        </li>
                        <li>
                            <a href="{{ route('track') }}"><i class="fas fa-truck"></i> Track Your Order</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.us') }}">Store Location</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.us') }}"><i class="fas fa-location-arrow"></i> Contact Us</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- topbar end -->

<!-- header area start -->
<section class="searchbg">
    <div class="container-fluid">
        <div class="row">
            <!-- logo -->
            <div class="col-lg-3 logo">
                <a href="{{ route('home.index') }}">
                    <img src="{{ asset('public') }}/images/{{ contacth()->logo ?? 'notfind.png' }}" width="100%"
                        height="auto" alt="logo">
                </a>
            </div>
            <!-- search -->
            <div class="col-lg-5 col-12 text-left">
                <div class="search">
                    {!! Form::open(['method' => 'POST', 'route' => 'search']) !!}
                    <div class="input-group ">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search for products, brands and more">
                        <div class="input-group-append">
                            <button class="input-group-text  border-0 rounded text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- icons area  -->
            <div class="col-lg-4 col-6 text-right">
                <div class="headerright">
                    <a href="{{ route('cart.list') }}">
                        <i class="fas fa-shopping-cart"></i> <span>{{ $cartCount }}</span>
                    </a>
                    @if (Auth::guard('mypanel')->user())
                        <a href="{{ route('mypanel.users') }}"><i class="fa fa-user"></i> My Account</a>
                        <span class="breaker"></span>
                        <a href="{{ route('mypanel.elogout') }}"> <i class="fa fa-lock"></i> Logout </a>
                    @else
                        <a href="{{ route('login') }}"> <i class="fa fa-user-circle"></i> Login</a> |
                        <a href="{{ route('register.user') }}">
                            Registration
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        {{--		<a class="navbar-brand" href="#">Mega Menu</a> --}}
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav navbar-light">
                <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                <!--========-->
                @foreach (categoryh() as $menu)
                    @if ($menu->slug == 'interior-design-services')
                        <li class="nav-item"><a class="nav-link"
                                href="{{ url('category') }}/{{ $menu->slug }}">{{ $menu->title }}</a></li>
                    @else
                        <li class="nav-item dropdown megamenu-li dmenu">

                            <a class="nav-link" href="{{ url('category') }}/{{ $menu->slug }}"
                                id="dropdown01">{{ $menu->title }}</a>
                            <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                                <div class="row">
                                    @php
                                        $subcats = \App\Models\Category::where('parent_id', $menu->id)->get();
                                        $brands = \App\Models\Product::groupBy('brand_id')
                                            ->select('brand_id')
                                            ->where('category_id', $menu->id)
                                            ->get();
                                        $colorss = \App\Models\Product::where('category_id', $menu->id)
                                            ->where('color', '!=', null)
                                            ->get();
                                        $sizess = \App\Models\Product::where('category_id', $menu->id)
                                            ->where('size', '!=', null)
                                            ->get();
                                        $bladess = \App\Models\Product::select('blade')
                                            ->where('category_id', $menu->id)
                                            ->where('blade', '!=', null)
                                            ->get();
                                    @endphp
                                    @if (count($subcats) > 0)
                                        <div class="col-sm-6 col-lg-2 mb-4">
                                            <h6>TYPE</h6>
                                            @foreach ($subcats as $subcat)
                                                <a class="dropdown-item"
                                                    href="{{ url('category') }}/{{ $subcat->slug }}">{{ $subcat->title }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($brands) > 0)
                                        <div class="col-sm-6 col-lg-2 mb-4">
                                            <h6>BRAND</h6>
                                            @foreach ($brands as $brand)
                                                <a class="dropdown-item"
                                                    href="{{ url('shops') }}/{{ $menu->slug }}/{{ $brand->brand->slug ?? '#' }}">{{ $brand->brand->title ?? 'N/A' }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($colorss) > 0)
                                        <div class="col-sm-6 col-lg-2 mb-4">
                                            <h6>COLOR</h6>
                                            @php
                                                $valuec = [];
                                                foreach ($colorss as $key => $colors) {
                                                    $valuec[] = $colors->color;
                                                }
                                                $color = array_unique(explode(',', implode(',', $valuec)));
                                            @endphp
                                            @foreach ($color as $colorsr)
                                                @php
                                                    $colorr = \App\Models\Atribute::where('id', $colorsr)->first();
                                                @endphp
                                                @if ($colorr != null)
                                                    <a class="dropdown-item"
                                                        href="{{ url('collection') }}/{{ $menu->slug }}/{{ $colorr->slug }}">
                                                        <i class="fas fa-solid fa-circle"
                                                            style="color: {{ $colorr->value }}"></i>{{ $colorr->name }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="col-sm-6 col-lg-2 mb-4">
                                        <h6>PRICE</h6>
                                        <a class="dropdown-item"
                                            href="{{ url('price') }}/{{ $menu->slug }}/0-5000">TK. 5000</a>
                                        <a class="dropdown-item"
                                            href="{{ url('price') }}/{{ $menu->slug }}/5001-10000">TK 5001 -
                                            TK10000</a>
                                        <a class="dropdown-item"
                                            href="{{ url('price') }}/{{ $menu->slug }}/10001-20000">TK 10001 - TK
                                            20000</a>
                                        <a class="dropdown-item"
                                            href="{{ url('price') }}/{{ $menu->slug }}/20001-50000">TK 20001- TK
                                            50000</a>
                                        <a class="dropdown-item"
                                            href="{{ url('price') }}/{{ $menu->slug }}/50001-100000">TK 50001 - TK
                                            100000</a>
                                        <a class="dropdown-item"
                                            href="{{ url('price') }}/{{ $menu->slug }}/100001-100000">Up TK
                                            100001</a>
                                    </div>
                                    @if (count($sizess) > 0)
                                        <div class="col-sm-6 col-lg-2 mb-4">
                                            <h6>SIZE</h6>
                                            @php
                                                $sizeec = [];
                                                foreach ($sizess as $key => $sizes) {
                                                    $sizeec[] = $sizes->size;
                                                }
                                                $size = array_unique(explode(',', implode(',', $sizeec)));
                                            @endphp
                                            @foreach ($size as $sizesr)
                                                @php
                                                    $sizer = \App\Models\Atribute::where('id', $sizesr)->first();
                                                @endphp
                                                @if ($sizer != null)
                                                    <a class="dropdown-item"
                                                        href="{{ url('collection') }}/{{ $menu->slug }}/{{ $sizer->slug }}">
                                                        {{ $sizer->name }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($bladess) > 0)
                                        <div class="col-sm-6 col-lg-2 mb-4">
                                            <h6>BLADE </h6>
                                            @php
                                                $sizeec = [];
                                                foreach ($bladess as $key => $sizes) {
                                                    $sizeec[] = $sizes->blade;
                                                }
                                                $size = array_unique(explode(',', implode(',', $sizeec)));
                                            @endphp
                                            @foreach ($size as $sizesr)
                                                @php
                                                    $sizer = \App\Models\Atribute::where('id', $sizesr)->first();
                                                @endphp
                                                @if ($sizer != null)
                                                    <a class="dropdown-item"
                                                        href="{{ url('collection') }}/{{ $menu->slug }}/{{ $sizer->slug }}">
                                                        {{ $sizer->name }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </li>
                    @endif
                @endforeach
                <!--=========-->
                {{--				<li class="nav-item"><a class="nav-link" href="portfolio.php">Blog</a></li> --}}
                {{--				<li class="nav-item"><a class="nav-link" href="contact-us.php">Contact us</a></li> --}}

            </ul>
        </div>
    </div>
</section>
<!-- Navbar End -->
<!--Mobile Menu Side Models Start-->
<header id="header-area" class="navbar-demo">
    <button type="" class="menu-btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
    <div class="mlogo ">
        <img src="{{ asset('public') }}/images/{{ contacth()->logo ?? 'notfind.png' }}">
    </div>
    <div class="usercom d-flex justify-content-center">
        @if (Auth::guard('mypanel')->user())
            <a href="{{ route('mypanel.users') }}"><i class="fa fa-user"></i></a>
        @else
            <a href="{{ route('login') }}"> <i class="fa fa-user-circle"></i></a> |
        @endif
    </div>
    <div class="cartcom d-flex justify-content-end">
        <a href="{{ route('cart.list') }}"> <i class="fas fa-shopping-cart"></i>
            <span>{{ $cartCount }}</span></a>
    </div>
    <div class="search">
        {!! Form::open(['method' => 'POST', 'route' => 'search']) !!}
        <div class="input-group ">
            <input type="text" name="search" class="form-control"
                placeholder="Search for products, brands and more">
            <div class="input-group-append">
                <button class="input-group-text  border-0 rounded text-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="nav-bar">
        <ul>
            <li>
                <a href="{{ route('home.index') }}">Home</a>
                @foreach (categoryh() as $menu)
                    <a href="{{ url('category') }}/{{ $menu->slug }}">{{ $menu->title }}</a>
                @endforeach
                {{--            <li> --}}
                {{--                <a href="#">UPTO 51% OFF</a> --}}
                {{--            </li> --}}
                {{--                @foreach (categoryh() as $menu) --}}
                {{--                <li> --}}
                {{--                    <a href="{{ url('category') }}/{{ $menu->slug }}">{{ $menu->title }} --}}
                {{--                    <ul> --}}
                {{--                        <li> --}}
                {{--                            <a href="">Home</a> --}}
                {{--                        </li> --}}
                {{--                        <li> --}}
                {{--                            <a href="">Home</a> --}}
                {{--                        </li> --}}
                {{--                        <li> --}}
                {{--                            <a href="">Home</a> --}}
                {{--                        </li> --}}
                {{--                    </ul> --}}
                {{--                    </a> --}}
                {{--                </li> --}}
                {{--                @endforeach --}}
                {{--            <li> --}}
                <a href="{{ route('about.us') }}">About Us</a>
                <a href="{{ route('contact.us') }}">Contact Us</a>
            </li>
        </ul>
    </div>
</header>

{{-- <header id="header-area" class="navbar-demo"> --}}
{{--	<div class="container"> --}}
{{--		<div class="row"> --}}
{{--			<nav class="navbar navbar-expand-lg " id="main_navbar"> --}}
{{--				<div class="container-fluid"> --}}
{{--					<button --}}
{{--							class="navbar-toggler" --}}
{{--							type="button" --}}
{{--							data-bs-toggle="collapse" --}}
{{--							data-bs-target="#navbarSupportedContent" --}}
{{--							aria-controls="navbarSupportedContent" --}}
{{--							aria-expanded="false" --}}
{{--							aria-label="Toggle navigation"> --}}
{{--						<i class="fas fa-solid fa-bars icons"></i> --}}
{{--					</button> --}}
{{--					<!-- logo --> --}}
{{--					<a class="navbar-brand d-lg-none" href="#"> --}}
{{--						<img src="./img/logo.png" alt="Logo" height="30"> --}}
{{--					</a> --}}
{{--					<!-- cart start --> --}}
{{--					<div class="cartsl"> --}}
{{--						<a href="#"><i class="fas fa-solid fa-cart-plus"></i></a> --}}
{{--						<a href="#"><i class="fas fa-solid fa-user"></i></a> --}}
{{--					</div> --}}
{{--					<!-- cart end --> --}}

{{--					<div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
{{--						<ul class="navbar-nav me-auto mb-2 mb-lg-0"> --}}
{{--							<li class="nav-item"> --}}
{{--								<a class="nav-link active" aria-current="page" href="#">Shop</a> --}}
{{--							</li> --}}
{{--							<li class="nav-item dropdown"> --}}
{{--								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Fan</a> --}}
{{--								<ul class="dropdown-menu"> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Type</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">BRANDS </a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">COLORS</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">PRICE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">SIZE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">BLADE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--								</ul> --}}
{{--							</li> --}}
{{--							<!-- second line menu  --> --}}
{{--							<li class="nav-item dropdown"> --}}
{{--								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">CHANDELIER FAN</a> --}}
{{--								<ul class="dropdown-menu"> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Type</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">BRANDS </a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">COLORS</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">PRICE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">SIZE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">BLADE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--								</ul> --}}
{{--							</li> --}}

{{--							<!-- Chandelier Fan --> --}}

{{--							<li class="nav-item dropdown"> --}}
{{--								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Chandelier Fan</a> --}}
{{--								<ul class="dropdown-menu"> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Type</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">BRANDS </a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">COLORS</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">PRICE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">SIZE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">BLADE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--								</ul> --}}
{{--							</li> --}}

{{--							<!-- Air Condition --> --}}

{{--							<li class="nav-item dropdown"> --}}
{{--								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Air Conditioner</a> --}}
{{--								<ul class="dropdown-menu"> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Type</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">BRANDS </a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">PRICE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">SIZE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--								</ul> --}}
{{--							</li> --}}

{{--							<!-- Interior Design Service--> --}}

{{--							<li class="nav-item dropdown"> --}}
{{--								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Interior Design Service </a> --}}
{{--								<ul class="dropdown-menu"> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Type</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">PRICE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--									<li class="nav-item dropdown"> --}}
{{--										<a --}}
{{--												class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">SIZE</a> --}}
{{--										<ul class="dropdown-menu"> --}}
{{--											<li><a class="dropdown-item" href="#">Ceiling Fan</a></li> --}}
{{--											<li> --}}
{{--												<a class="dropdown-item" href="#">Wall Fan</a> --}}
{{--											</li> --}}

{{--										</ul> --}}
{{--									</li> --}}
{{--								</ul> --}}
{{--							</li> --}}
{{--							<!-- second line end  --> --}}
{{--						</ul> --}}
{{--					</div> --}}
{{--				</div> --}}
{{--			</nav> --}}
{{--		</div> --}}
{{--	</div> --}}
{{-- </header> --}}
<!--Mobile Menu Side Models End-->
