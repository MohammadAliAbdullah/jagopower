@extends('Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Brand <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">{{ $brand->title ?? 'N/A' }}</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Product part start -->
    <section class="categorybg">
        <div class="container-fluid">
            <div class="row">
                @include('Frontend.Layout.sidebar')
                <div class="col-12 col-md-9">
                    <div class="row">
                        @foreach($cat_products as $recent)
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="product-item">
                                    <span class="badge badge-danger">30%</span>
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('public/images/product') }}/{{ $recent->thumb }}" alt="">
                                        <div class="product-action">
                                            {!! Form::open(['method'=>'POST','route'=>'cart.Store']) !!}
                                            {!! Form::hidden('id', $recent->id) !!}
                                            {!! Form::hidden('name', $recent->title) !!}
                                            {!! Form::hidden('thumbnail_img', $recent->thumb) !!}
                                            @if(!empty($recent->sales_price) OR $recent->sales_price!=0)
                                                {!! Form::hidden('price', $recent->sales_price) !!}
                                            @else
                                                {!! Form::hidden('price', 0) !!}
                                            @endif
                                            {!! Form::hidden('quantity', 1) !!}
                                            {!! Form::hidden('slug', $recent->slug) !!}
                                            <button class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></button>
                                            {!! Form::close() !!}
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('product_details', ['id' => $recent->slug]) }}"><i class="far fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="productdetails">
                                        <a href="{{ route('product_details', ['id' => $recent->slug]) }}">{!! Str::limit($recent->title, 40, ' ...') !!}</a>
                                        <p><del>Tk {{ $recent->regular_price ?? 'N/A' }}</del> Tk {{ $recent->sales_price ?? 'N/A' }} </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 m-0 float-right">
                            {{ $cat_products->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('public') }}/asset/css/category.css">
@endsection

@section('script')

@endsection
