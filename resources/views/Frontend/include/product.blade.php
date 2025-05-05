<div class="product-item">
    {{--									<span class="badge badge-danger">30%</span>--}}
    <div class="product-img position-relative overflow-hidden productsss">
        <img class="img-fluid" src="{{ asset('public/images/product') }}/{{ $product->images }}" alt="">
        <div class="product-action">
            {!! Form::open(['method'=>'POST','route'=>'cart.Store']) !!}
            {!! Form::hidden('id', $product->id) !!}
            {!! Form::hidden('name', $product->title) !!}
            {!! Form::hidden('thumbnail_img', $product->thumb) !!}
            @if(!empty($product->sales_price) OR $product->sales_price!=0)
                {!! Form::hidden('price', $product->sales_price) !!}
            @else
                {!! Form::hidden('price', 0) !!}
            @endif
            {!! Form::hidden('quantity', 1) !!}
            {!! Form::hidden('slug', $product->slug) !!}
            <button class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></button>
            {!! Form::close() !!}
            <a class="btn btn-outline-dark btn-square viewProductDetails" data-url="{{ route('product_quick_view_details', ['id' => $product->slug]) }}"><i class="far fa-eye"></i></a>
        </div>
    </div>
    <div class="productdetails">
        <a href="{{ route('product_details', ['id' => $product->slug]) }}">{!! Str::limit($product->title, 32, ' ...') !!}</a>
        <p><del>Tk {{ $product->regular_price ?? 'N/A' }}</del> Tk {{ $product->sales_price ?? 'N/A' }} </p>
        @if($product->color !=NULL)
            @php
                $colors=explode(',',$product->color);
            @endphp
            <div class="d-flex">
                <div class="sizes">
                    @foreach($colors as $val)
                        @php
                            $atts=\App\Models\Atribute::where('id',$val)->first();
                        @endphp
                        <label class="color"  style="width: 20px; height: 20px; margin-left: 10px; border-radius: 50%;  background-position: center; background:{{ $atts->value }}"></label>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>