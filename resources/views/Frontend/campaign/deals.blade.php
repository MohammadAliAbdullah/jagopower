@extends('Frontend.Layout.master')

@section('content')
    <section>

        <div class="main-section-area" style="padding: 0; background: {{ $deals->background_color }}; color: {{ $deals->text_color }};">
            <div class="container-fluid" style="padding: 0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner_campaign">
                            <img src="{{ asset('public/images/campaign') }}/{{  $deals->banner }}" alt="" class="img-fluid">
                        </div>

                        <div class="rounded bg-gradient-4 text-white text-center">
                            <h1 class="text-center">{{ $deals->title }}</h1>
                            <div id="countdown1" style="color: {{ $deals->text_color }};"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-section-area" style="padding: 0; background: {{ $deals->background_color }}; color: {{ $deals->text_color }};">
            <div class="container-fluid">
                <div class="row">
                    @foreach($products as $value)
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                            <div class="product-area">
                                <div class="product-img text-center">
                                    <a href="{{ route('product_details', ['id' => $value->product->slug]) }}">
                                        <img data-original="{{ asset('public/images/product/'.$value->product->thumb) }}" alt="img">
                                    </a>
                                    {!! Form::open(['method'=>'POST','route'=>'cart.Store']) !!}
                                    {!! Form::hidden('id', $value->product->id) !!}
                                    {!! Form::hidden('name', $value->product->title) !!}
                                    {!! Form::hidden('thumbnail_img', $value->product->thumb) !!}
                                    @if(!empty($value->product->sales_price))
                                        {!! Form::hidden('price', $value->product->sales_price) !!}
                                    @endif
                                    {!! Form::hidden('slug', $value->product->slug) !!}
                                    {!! Form::hidden('quantity', 1) !!}
                                    <div class="footware-overley text-center">
                                        @if(!empty($value->product->productstock->colored) OR !empty($value->product->productstock->sized))
                                            <button class="btn btn-warning btncard text-center">add to cart</button>
                                        @else
                                            <a href="{{ route('product_details', ['id' => $value->product->slug]) }}">View Details</a>
                                        @endif
                                    </div>
                                    {!! Form::close() !!}
                                    <div class="top-offer">
                                        @if($value->discount_type=='Percent')
                                            <span>{{ $value->discount }}%</span>
                                        @else
                                            <span>{{ $value->discount }}ট</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-text text-center">
                                    <a href="{{ route('product_details', ['id' => $value->product->slug]) }}"><p class="phrg">{{ $value->product->title }}</p></a>
                                    <p class="price-card">
                                        @if(!empty($value->product->regular_price))
                                           <del> ট {{ $value->product->regular_price }}</del>
                                        @else
                                            0
                                        @endif
                                        @if(!empty($value->product->regular_price))
                                            <span> ট
                                                @php
                                                $sales=$value->discount;
                                                $type=$value->discount_type;
                                                if($type=='Percent'){
                                                    $amount1=($value->product->regular_price*$sales)/100;
                                                    $amount=$value->product->regular_price-$amount1;
                                                    echo $amount;
                                                }else{
                                                    $amount=$value->product->regular_price-$sales;
                                                    echo $amount;
                                                }
                                                @endphp
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        {{ $products->render() }}
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>

@endsection

@section('script')
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("{{ date('M d Y H:m:s', $deals->end_date) }}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("countdown1").innerHTML = days + ": " + hours + ": "
                + minutes + ": " + seconds + " ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown1").innerHTML = "EXPIRED";
            }
        }, 1000);

    </script>
@endsection
