@extends('Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Blog <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Blog</span>
                    </nav>
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
                        <img src="{{ asset('public/images/blogs/' . $value->images) }}" class="img-fluid">
                        <p class="text-justify">{!! $value->content !!}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebarblog">
                        <h5>Latest Post</h5>
                        <div class="blogside">
                            @foreach ($recents as $recent)
                                <div class="card">
                                    <img src="{{ asset('public/images/blogs/' . $recent->images) }}" class="card-img-top" />
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
