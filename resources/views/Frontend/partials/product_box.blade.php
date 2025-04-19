@foreach($products as $product)
    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
        <div class="product-area">
            <div class="product-img text-center">
                <a href="{{ route('product_details', ['id' => $product->slug]) }}">
                    <img data-original="{{ asset('public/images/product/'.$product->thumb) }}" alt="img">
                </a>
                {!! Form::open(['method'=>'POST','route'=>'cart.Store']) !!}
                {!! Form::hidden('id', $product->id) !!}
                {!! Form::hidden('name', $product->title) !!}
                {!! Form::hidden('thumbnail_img', $product->thumb) !!}
                @if(!empty($product->productstock->sales_price))
                    {!! Form::hidden('price', $product->productstock->sales_price) !!}
                @endif
                {!! Form::hidden('slug', $product->slug) !!}
                {!! Form::hidden('quantity', 1) !!}
                <div class="footware-overley text-center">
                    @if(!empty($product->productstock->colored) OR !empty($product->productstock->sized))
                        <button class="btn btn-warning btncard text-center">add to cart</button>
                    @else
                        <a href="{{ route('product_details', ['id' => $product->slug]) }}">View Details</a>
                    @endif
                </div>
                {!! Form::close() !!}
                {{--                                                <div class="top-offer">--}}
                {{--                                                    <span>29%</span>--}}
                {{--                                                </div>--}}
            </div>
            <div class="product-text text-center">
                <a href="{{ route('product_details', ['id' => $product->slug]) }}"><p class="phrg">{{ $product->title }}</p></a>
                <p class="price-card">ট
                    @if(!empty($product->productstock->sales_price))
                        {{ $product->productstock->sales_price }}
                    @else
                        0
                    @endif
                </p>
            </div>
        </div>
    </div>
@endforeach