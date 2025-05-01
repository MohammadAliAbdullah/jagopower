@extends('Frontend.Layout.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Shop <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Shop</span>
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
                    <div class="row filter_data">
                        @foreach ($cat_products as $recent)
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="product-item">
                                    {{--									<span class="badge badge-danger">30%</span> --}}
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('public/images/product') }}/{{ $recent->thumb }}" alt="">
                                        <div class="product-action">
                                            {!! Form::open(['method' => 'POST', 'route' => 'cart.Store']) !!}
                                            {!! Form::hidden('id', $recent->id) !!}
                                            {!! Form::hidden('name', $recent->title) !!}
                                            {!! Form::hidden('thumbnail_img', $recent->thumb) !!}
                                            @if (!empty($recent->sales_price) or $recent->sales_price != 0)
                                                {!! Form::hidden('price', $recent->sales_price) !!}
                                            @else
                                                {!! Form::hidden('price', 0) !!}
                                            @endif
                                            {!! Form::hidden('quantity', 1) !!}
                                            {!! Form::hidden('slug', $recent->slug) !!}
                                            <button class="btn btn-outline-dark btn-square"><i
                                                    class="fa fa-shopping-cart"></i></button>
                                            {!! Form::close() !!}
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('product_details', ['id' => $recent->slug]) }}"><i
                                                    class="far fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="productdetails">
                                        <a
                                            href="{{ route('product_details', ['id' => $recent->slug]) }}">{!! Str::limit($recent->title, 40, ' ...') !!}</a>
                                        <p><del>Tk {{ $recent->regular_price ?? 'N/A' }}</del> Tk
                                            {{ $recent->sales_price ?? 'N/A' }} </p>
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
    <style>
        #loading {
            text-align: center;
            background: url('{{ asset('public/images') }}/loader.gif') no-repeat center;
            height: 150px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {

            filter_data();

            function filter_data() {
                //$('.filter_data').html('<div id="loading" style="" ></div>');
                //var action = 'fetch_data';
                //var minimum_price = $('#hidden_minimum_price').val();
                //var maximum_price = $('#hidden_maximum_price').val();
                var brand = get_filter('brand');
                var category = get_filter('category');
                var size = get_filter('size');
                var color = get_filter('color');
                $.ajax({
                    url: "{{ url('shopfilter') }}",
                    method: "POST",
                    data: {
                        brand: brand,
                        category: category,
                        size: size,
                        color: color
                    },
                    success: function(data) {
                        //console.log(data)
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.sort_rang').click(function() {
                filter_data();
            });

            $('#price_range').slider({
                range: true,
                min: 1000,
                max: 65000,
                values: [1000, 65000],
                step: 500,
                stop: function(event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });

        });
    </script>
@endsection
