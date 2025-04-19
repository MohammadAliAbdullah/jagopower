@extends('Frontend.Layout.master')

@section('content')
    <section>

        <div class="main-section-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Today Offer</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">


                    <div class="col-lg-12">




                        <!-- shop-page-product-area-start -->

                        <div class="shop-page-product">

                            <div class="row">

                                @foreach($products as $cat_product)
                                    <div class="col-md-2 col-sm-6 col-6 ">
                                        <div class="product-area">
                                            <div class="product-img text-center">
                                                <a href="{{ route('product_details', ['id' => $cat_product->slug]) }}">
                                                    <img src="{{ asset('public/images/product') }}/{{ $cat_product->thumb }}" alt="{{ $cat_product->title }}">
                                                </a>
                                                {!! Form::open(['method'=>'POST','route'=>'cart.Store']) !!}
                                                {!! Form::hidden('id', $cat_product->id) !!}
                                                {!! Form::hidden('name', $cat_product->title) !!}
                                                {!! Form::hidden('thumbnail_img', $cat_product->thumb) !!}
                                                @if(!empty($cat_product->productstock->sales_price))
                                                    {!! Form::hidden('price', $cat_product->productstock->sales_price) !!}
                                                @endif
                                                {!! Form::hidden('slug', $cat_product->slug) !!}
                                                {!! Form::hidden('quantity', 1) !!}
                                                <div class="footware-overley text-center">
                                                    @if(!empty($cat_product->productstock->colored) OR !empty($cat_product->productstock->sized))
                                                        <button class="btn btn-warning btncard text-center">add to cart</button>
                                                    @else
                                                        <a href="{{ route('product_details', ['id' => $cat_product->slug]) }}">View Details</a>
                                                    @endif

                                                </div>
                                                {!! Form::close() !!}
                                                {{--                                            <div class="top-offer">--}}
                                                {{--                                                <span>29%</span>--}}
                                                {{--                                            </div>--}}
                                            </div>
                                            <div class="product-text text-center">
                                                <p class="phrg">
                                                    <a href="{{ route('product_details', ['id' => $cat_product->slug]) }}">
                                                        {{ $cat_product->title }}
                                                    </a>
                                                </p>
                                                <p class="price-card">ট
                                                    @if(!empty($cat_product->productstock->sales_price))
                                                        {{ $cat_product->productstock->sales_price }}
                                                    @else
                                                        0
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                        </div>



                    </div>
                    <!-- md-9-col-emd  -->

                    <!-- shop-page-product-area-end -->
                </div>
            </div>


        </div>
        </div>

    </section>

@endsection

@section('script')
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        };
    </script>
@endsection
