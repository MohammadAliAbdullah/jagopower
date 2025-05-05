@extends('Frontend.Layout.master')
@if (!empty($product->meta_title))
    @section('meta_title', $product->meta_title)
@else
    @section('meta_title', $seo->meta_title)
@endif
@if (!empty($product->meta_keyword))
    @section('meta_keywords', $product->meta_keyword)
@else
    @section('meta_keywords', $seo->meta_keyword)
@endif
@if (!empty($product->meta_description))
    @section('meta_description', $product->meta_description)
@else
    @section('meta_description', $seo->meta_description)
@endif
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Shop Detail <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Celling Fan</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Detail Start -->
    <div class="productdatbg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="productdet zoom-option">
                        <img class="xzoom lazy" id="xzoom-default" src="{{ asset('public/images/product/' . $product->images) }}" xoriginal="{{ asset('public/images/product/' . $product->images) }}" />
                        <div class="owl-carousel xzoom-thumbs">
                            @if (!empty($gallery[0]))
                                @foreach ($gallery as $key => $img)
                                    <a href="{{ asset('public/images/product/' . $img) }}">
                                        <img class="xzoom-gallery " width="80"
                                            src="{{ asset('public/images/product/' . $img) }}">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- product info -->
                <div class="col-lg-7">
                    <div class="productdets">
                        <h3>{{ $product->title ?? 'N/A' }}</h3>
                        <div class="proinfo">
                            <p><b>Category:</b> {{ $product->category->title ?? 'N/A' }}</p>
                            <p><b>Brand:</b> {{ $product->brand->title ?? 'N/A' }}</p>
                            <p><b>SKU:</b> {{ $product->sku ?? 'N/A' }}</p>
                            <p>
                                <b>Availability:</b>
                                @if ($product->qty != 0)
                                    in Stock
                                @else
                                    <span class="text-danger">Out of Stock</span>
                                @endif
                            </p>
                        </div>
                        {!! Form::open(['method' => 'POST', 'url' => 'add']) !!}
                        {!! Form::hidden('id', $product->id) !!}
                        {!! Form::hidden('name', $product->title) !!}
                        {!! Form::hidden('thumbnail_img', $product->thumb) !!}
                        {!! Form::hidden('slug', $product->slug) !!}
                        @if (!empty($product->sales_price) or $product->sales_price != 0)
                            {!! Form::hidden('price', $product->sales_price) !!}
                        @else
                            {!! Form::hidden('price', 0) !!}
                        @endif
                        <h4>Price: <del>Tk {{ $product->regular_price ?? 'N/A' }}</del> <span class="text-danger">Tk
                                {{ $product->sales_price ?? 'N/A' }}</span> </h4>
                        @if ($product->size != null)
                            @php
                                $sizes = explode(',', $product->size);
                            @endphp
                            <div class="d-flex mb-3">
                                <div class="sizes">
                                    <p class="text-uppercase"><b>Size:</b></p>
                                    <label class="radio">
                                        @foreach ($sizes as $val)
                                            @php
                                                $atts = \App\Models\Atribute::where('id', $val)->first();
                                            @endphp
                                            <input type="radio" name="size" value="{{ $val }}" checked>
                                            <span>{{ $atts->value }}"</span>
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if ($product->color != null)
                            @php
                                $colors = explode(',', $product->color);
                            @endphp
                            <div class="d-flex mb-3">
                                <div class="sizes">
                                    <h6 class="text-uppercase">Color</h6>
                                    @foreach ($colors as $val)
                                        @php
                                            $atts = \App\Models\Atribute::where('id', $val)->first();
                                        @endphp
                                        <label class="color">
                                            <input type="radio" name="color" value="{{ $val }}" checked>
                                            <span class="bg" style="background:{{ $atts->value }}"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <input type="number" class="form-control bg-secondary border-0 text-center" name="quantity"
                                    value="1">
                            </div>
                            <button class="btn cart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                Cart</button>
                        </div>
                        {!! Form::close() !!}
                        <div class="d-flex pt-2">
                            @php
                                $date1 = date('Y-m-d') . ' 03:00:00';
                                $date2 = date('Y-m-d') . ' ' . date('H:i') . ':00';
                                $timestamp1 = strtotime($date1);
                                $timestamp2 = strtotime($date2);
                                $hour = abs($timestamp2 - $timestamp1) / (60 * 60);
                                //echo intval($hour);
                            @endphp
                            <i class="fa fa-fire text-danger"></i> {{ rand(1, 10) }} sold in last {{ intval($hour) }}
                            hours
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    <!-- product description  -->
    <section class="details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="producttab">
                        <div class="nav nav-tabs mb-4">
                            <a class="nav-item nav-link text-dark active" data-toggle="tab"
                                href="#tab-pane-1">Description</a>
                            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Specification</a>
                            {{--                            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> --}}
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <h4 class="mb-3">Product Description</h4>
                                <p>
                                    {!! $product->content ?? 'N/A' !!}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-2">
                                <h4 class="mb-3">Additional Information</h4>
                                <p>
                                    {!! $product->specification ?? 'N/A' !!}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-4">1 review for "{{ $product->title }}"</h4>
                                        <div class="media mb-4">
                                            <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                                style="width: 45px;">
                                            <div class="media-body">
                                                <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam
                                                    ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod
                                                    ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Leave a review</h4>
                                        <small>Your email address will not be published. Required fields are marked
                                            *</small>
                                        <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Your Rating * :</p>
                                            <div class="text-primary">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-group">
                                                <label for="message">Your Review *</label>
                                                <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Your Name *</label>
                                                <input type="text" class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Your Email *</label>
                                                <input type="email" class="form-control" id="email">
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" value="Leave Your Review"
                                                    class="btn btn-primary px-3">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- related Start -->
    <section class="related">
        <div class="container">
            <h2>Related Product</h2>
            <div class="row">
                <div class="col">
                    <div class="owl-carousel related-carousel">
                        @foreach ($similar_products as $similar_product)
                            <div class="product-item">
                                {{--                                <span class="badge badge-danger">30%</span> --}}
                                <div class="product-img position-relative overflow-hidden rooms">
                                    <img class="img-fluid"
                                        src="{{ asset('public/images/product') }}/{{ $similar_product->thumb }}"
                                        alt="">
                                    <div class="product-action">
                                        {!! Form::open(['method' => 'POST', 'route' => 'cart.Store']) !!}
                                        {!! Form::hidden('id', $similar_product->id) !!}
                                        {!! Form::hidden('name', $similar_product->title) !!}
                                        {!! Form::hidden('thumbnail_img', $similar_product->thumb) !!}
                                        @if (!empty($similar_product->sales_price) or $similar_product->sales_price != 0)
                                            {!! Form::hidden('price', $similar_product->sales_price) !!}
                                        @else
                                            {!! Form::hidden('price', 0) !!}
                                        @endif
                                        {!! Form::hidden('quantity', 1) !!}
                                        {!! Form::hidden('slug', $similar_product->slug) !!}
                                        <button class="btn btn-outline-dark btn-square"><i
                                                class="fa fa-shopping-cart"></i></button>
                                        {!! Form::close() !!}
                                        <a class="btn btn-outline-dark btn-square"
                                            href="{{ route('product_details', ['id' => $similar_product->slug]) }}"><i
                                                class="far fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="productdetails">
                                    <a
                                        href="{{ route('product_details', ['id' => $similar_product->slug]) }}">{!! Str::limit($similar_product->title, 32, ' ...') !!}</a>
                                    <p><del>Tk {{ $similar_product->regular_price ?? 'N/A' }}</del> Tk
                                        {{ $similar_product->sales_price ?? 'N/A' }} </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- releted End -->
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('public') }}/asset/css/xzoom.css">
    <link rel="stylesheet" href="{{ asset('public') }}/asset/css/product.css">
@endsection

@section('script')
    <script src="{{ asset('public') }}/asset/js/xzoom.min.js"></script>
    <script src="{{ asset('public') }}/asset/js/setup.js"></script>
@endsection
