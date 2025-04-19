@extends('Frontend.Layout.master')
@if(!empty($page->meta_title))
    @section('meta_title', $page->meta_title)
@else
    @section('meta_title', $seo->meta_title)
@endif
@if(!empty($page->meta_keyword))
    @section('meta_keywords',$page->meta_keyword)
@else
    @section('meta_keywords', $seo->meta_keyword)
@endif
@if(!empty($page->meta_description))
    @section('meta_description', $page->meta_description)
@else
    @section('meta_description', $seo->meta_description)
@endif
@section('content')
    <!-- main-section-area-start -->
    <section class="cart-banner-add">
        <div class="container-fluid box">
            <h6>Home ➞&ensp;</h6>
            <h6>Privacy Policy.</h6>
        </div>
    </section>
    <section>

        <div class="main-section-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="about p-3">
                                        <h2 class="text-center">Privacy Policy.</h2>
                                        <p>
                                            {!! $page->content !!}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>

    </section>

    <!-- main-section-area-start -->

@endsection