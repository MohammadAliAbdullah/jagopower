@extends('Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg" style="background: linear-gradient(
      rgb(8 8 8 / 56%), rgb(40 40 40 / 51%)
    ), url({{ asset('public/asset') }}/img/bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        {{--						<a class="breadcrumb-item" href="#">Shop <i class="fa fa-angle-right"></i></a>--}}
                        <span class="breadcrumb-item">Blog</span>
                    </nav>
                    <h1 class="text-center">Blog</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <section class="cartbg">
        <div class="container blogbg">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blogdetails pb-3">
                        <h2>{{ $value->title }}</h2>
                        <img src="{{ asset('public/images/blogs/'.$value->images) }}" class="img-fluid">
                        <p class="text-justify">{!! $value->content !!}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebarblog">
                        <h5>Latest Post</h5>
                        <div class="blogside">
                            @foreach($recents as $recent)
                                <div class="card">
                                    <img src="{{ asset('public/images/blogs/'.$recent->images) }}" class="card-img-top" />
                                    <div class="card-body">
                                        <p class="card-text">
                                            {{ $recent->title }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- paymnt -->
            </div>
        </div>
    </section>
    <!-- Cart End -->
@endsection
@section('style')
    <link href="{{ asset('public') }}/asset/css/blog.css" rel="stylesheet">
@endsection