@extends('Frontend.Layout.master')
@if (!empty($category->meta_title))
    @section('meta_title', $category->meta_title)
@else
    @section('meta_title', $seo->meta_title)
@endif
@if (!empty($category->meta_keyword))
    @section('meta_keywords', $category->meta_keyword)
@else
    @section('meta_keywords', $seo->meta_keyword)
@endif
@if (!empty($category->meta_description))
    @section('meta_description', $category->meta_description)
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
                        <a class="breadcrumb-item" href="#">Category <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">{{ $category->title ?? 'N/A' }}</span>
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
                @php
                    //$subcats=\App\Models\Category::where('parent_id',$category->id)->get();
                    //                    $subcats=\App\Models\Product::groupBy('sub_category_id')->select('sub_category_id')->where('category_id',$category->id)->where('sub_category_id','!=',0)->get();
                    //                    $brands=\App\Models\Product::groupBy('brand_id')->select('brand_id')->where('category_id',$category->id)->where('brand_id','!=',0)->get();
                    //                    $colorss=\App\Models\Product::select('color')->where('category_id',$category->id)->where('color','!=',NULL)->get();
                    //                    $sizess=\App\Models\Product::select('size')->where('category_id',$category->id)->where('size','!=',NULL)->get();
                    //                    $bladess=\App\Models\Product::select('blade')->where('category_id',$category->id)->where('blade','!=',NULL)->get();
                    //dd($brands);
                @endphp
                <div class="col-12 col-md-3">
                    @if (count($brands) > 0)
                        <div class="sidebar">
                            <h4>Brand: </h4>
                            <ul>
                                @foreach ($brands as $brand)
                                    <li>
                                        <label>
                                            <input type="checkbox" class="sort_rang brand" id="brand" name="brand[]"
                                                value="{{ $brand->brand->id }}"> {{ $brand->brand->title ?? 'N/A' }}
                                        </label>
                                    </li>
                                @endforeach
                                {{--                                <button class="btn btn-info">Submit</button> --}}
                            </ul>
                        </div>
                    @endif
                    @if (count($subcats) > 0)
                        <div class="sidebar">
                            <h4>Type</h4>
                            <ul>
                                @foreach ($subcats as $categorie)
                                    <li>
                                        <label>
                                            <input type="checkbox" class="sort_rang category" id="category"
                                                name="category[]" value="{{ $categorie->subcategory->id }}">
                                            {{ $categorie->subcategory->title ?? 'N/A' }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (count($colorss) > 0)
                        <div class="sidebar" style="height: 100px">
                            <h4>Color: </h4>
                            <ul>
                                @php
                                    $arra = [];
                                    foreach ($colorss as $tag) {
                                        $arra[] = $tag->color;
                                    }
                                    $aer = implode(',', $arra ?? '');
                                    $colorr = explode(',', implode(',', array_unique(explode(',', $aer))));
                                @endphp
                                @foreach ($colorr as $color)
                                    @php
                                        $colorrr = \App\Models\Atribute::where('id', $color)->first();
                                    @endphp
                                    @if ($colorrr != null)
                                        <li style="float: left;">
                                            <label>
                                                <input type="checkbox" class="sort_rang color" id="color" name="color[]"
                                                    value="{{ $colorrr->id }}" style="display: none;">
                                                <span
                                                    style="color:{{ $colorrr->value }}; background-color:{{ $colorrr->value }}; box-shadow: 1px 1px 5px black; border-radius: 100%;">⬤
                                                </span>
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (count($sizess) > 0)
                        <div class="sidebar">
                            <h4>Size: </h4>
                            <ul>
                                @php
                                    $arra1 = [];
                                    foreach ($sizess as $size) {
                                        $arra1[] = $size->size;
                                    }
                                    $aer1 = implode(',', $arra1 ?? '');
                                    $sizer = explode(',', implode(',', array_unique(explode(',', $aer1))));
                                @endphp
                                @foreach ($sizer as $sizerr)
                                    @php
                                        $sizerrr = \App\Models\Atribute::where('id', $sizerr)->first();
                                    @endphp
                                    @if ($sizerrr != null)
                                        <li>
                                            <label>
                                                <input type="checkbox" class="sort_rang size" id="size" name="size[]"
                                                    value="{{ $sizerrr->id }}"> {{ $sizerrr->name ?? 'N/A' }}
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="sidebar">
                        <h4>Price: </h4>
                        <ul>
                            <li>
                                <label>
                                    <input type="radio" class="sort_rang price" id="price" name="price[]"
                                        value="0-5000"> TK. 5000
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" class="sort_rang price" id="price" name="price[]"
                                        value="5001-10000"> TK 5001 - TK10000
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" class="sort_rang price" id="price" name="price[]"
                                        value="10001-20000"> TK 10001 - TK 20000
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" class="sort_rang price" id="price" name="price[]"
                                        value="20001-50000"> TK 20001- TK 50000
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" class="sort_rang price" id="price" name="price[]"
                                        value="50001-100000"> TK 50001 - TK 100000
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" class="sort_rang price" id="price" name="price[]"
                                        value="100000-100000"> Up TK 100001
                                </label>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-12 col-md-9">
                    @if (isset($category->content))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p-3">
                                    <h2>{{ $category->title }}</h2>
                                    <p class="text-justify">
                                        {!! $category->content !!}
                                    </p>
                                </div>

                            </div>
                        </div>
                    @endif
                    @if (count($categories) > 0)
                        <div class="row">
                            <div class="col-12">
                                <h3 class="pt-3">Sub Category</h3>
                            </div>
                            @foreach ($categories as $categorr)
                                @php
                                    $subproduct = \App\Models\Product::where('sub_category_id', $categorr->id)->count();
                                @endphp

                                <div class="col-4 col-lg-4 col-md-4">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="{{ url('category') }}/{{ $categorr->slug }}">
                                                @if ($categorr->thumb != null)
                                                    <img class="media-object img-fluid"
                                                        src="{{ asset('public/images/category') }}/{{ $categorr->thumb }}"
                                                        alt="{{ $categorr->title }}">
                                                @else
                                                    <img class="media-object img-fluid"
                                                        src="{{ asset('public/images') }}/notfind.png"
                                                        alt="{{ $categorr->title }}">
                                                @endif
                                            </a>
                                        </div>
                                        <a href="{{ url('category') }}/{{ $categorr->slug }}">
                                            <div class="media-body">
                                                <p class="media-heading">{{ $categorr->title }}</p>
                                                <span>{{ $subproduct ?? 0 }} items</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="row filter_data">
                        @foreach ($cat_products as $recent)
                            <div class="col-6 col-lg-3 col-md-3">
                                <div class="product-item">
                                    {{--                                <span class="badge badge-danger">30%</span> --}}
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('public/images/product') }}/{{ $recent->thumb }}"
                                            alt="">
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
                        <div class="row">
                            <div class="col-12 col-md-6 offset-md-2 m-0" style="overflow: hidden">
                                {{ $cat_products->onEachSide(0)->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('public') }}/asset/css/category.css">
    <style>
        #loading {
            text-align: center;
            background: url('{{ asset('public/images') }}/loader.gif') no-repeat center;
            height: 150px;
        }
    </style>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            //$('select').on('body', function() {
            filter_data();

            function filter_data() {
                $("input").change(function() {
                    $('.filter_data').html('<div id="loading" style="" ></div>');
                    var action = '{{ $category->slug }}';
                    //var minimum_price = $('#hidden_minimum_price').val();
                    //var maximum_price = $('#hidden_maximum_price').val();
                    var brand = get_filter('brand');
                    var category = get_filter('category');
                    var size = get_filter('size');
                    var color = get_filter('color');
                    var price = get_filter('price');
                    $.ajax({
                        url: "{{ url('shopfilters') }}",
                        method: "POST",
                        data: {
                            action: action,
                            brand: brand,
                            category: category,
                            size: size,
                            color: color,
                            price: price
                        },
                        success: function(data) {
                            $('.filter_data').html(data);
                        }
                    });
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
            // });
        });
    </script>
@endsection
