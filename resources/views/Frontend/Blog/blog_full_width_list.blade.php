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
                    <div class="blogbg">
                        <div class="row">
                            @foreach ($blogs as $blog)
                                <div class="col-md-6">
                                    <div class="blogbox pb-3">
                                        <img src="{{ asset('public/images/blogs/' . $blog->images) }}">
                                        <h5>{{ $blog->title }}</h5>
                                        <p>{!! Str::limit($blog->content, 40, ' ...') !!}</p>
                                        <a href="{{ url('blogs') }}/{{ $blog->slug }}">Read More</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-2 m-0 float-right">
                                {{ $blogs->render() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebarblog">
                        <h5>Latest Post</h5>
                        <div class="blogside">
                            @foreach ($recents as $recent)
                                <a href="{{ url('blogs') }}/{{ $recent->slug }}">
                                    <div class="card">
                                        <img src="{{ asset('public/images/blogs/' . $recent->images) }}"
                                            class="card-img-top" />
                                        <div class="card-body">
                                            <p class="card-text">
                                                {{ $recent->title }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
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
