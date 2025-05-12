<style>
    p>img {
        width: 300px !important;
        height: 300px !important;
    }

    .modal-body {
        overflow: visible;
    }

    .img-zoom-container {
        position: relative;
        display: inline-block;
    }

    /* Fix xZoom z-index issue inside modal */
    .xzoom-preview,
    .xzoom-lens,
    .xzoom-loading {
        z-index: 1065 !important;
    }
</style>
<div class="p-4">
    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6">
            <div class="position-relative">
                <img class="xzoom w-100 rounded border" id="xzoom-default"
                    src="{{ asset('public/images/product/' . $product->images) }}"
                    xoriginal="{{ asset('public/images/product/' . $product->images) }}" />

                <div class="d-flex mt-3">
                    @if (!empty($gallery[0]))
                        @foreach ($gallery as $img)
                            <a class="me-2">
                                <img class="xzoom-gallery rounded border" width="60"
                                    src="{{ asset('public/images/product/' . $img) }}">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <h4 class="fw-bold">{{ $product->title ?? 'N/A' }}</h4>
            <p class="text-muted mb-1">Category: <span
                    class="fw-semibold">{{ $product->category->title ?? 'N/A' }}</span></p>
            <p class="text-muted mb-1">Brand: <span class="fw-semibold">{{ $product->brand->title ?? 'N/A' }}</span></p>
            <p class="text-muted mb-1">SKU: <span class="fw-semibold">{{ $product->sku ?? 'N/A' }}</span></p>
            <p class="mb-2">
                Availability:
                @if ($product->qty != 0)
                    <span class="text-success">In Stock</span>
                @else
                    <span class="text-danger">Out of Stock</span>
                @endif
            </p>

            <h5>
                Price:
                <del class="text-muted">Tk {{ $product->regular_price ?? 'N/A' }}</del>
                <span class="text-danger ms-2">Tk {{ $product->sales_price ?? 'N/A' }}</span>
            </h5>

            {!! Form::open(['method' => 'POST', 'url' => 'add']) !!}
            {!! Form::hidden('id', $product->id) !!}
            {!! Form::hidden('name', $product->title) !!}
            {!! Form::hidden('thumbnail_img', $product->thumb) !!}
            {!! Form::hidden('slug', $product->slug) !!}
            {!! Form::hidden('price', $product->sales_price ?: 0) !!}

            @if ($product->size)
                @php $sizes = explode(',', $product->size); @endphp
                <div class="mb-3 d-flex align-items-center">
                    <label class="form-label me-3 mb-0" style="min-width: 50px;"><strong>Size</strong></label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        @foreach ($sizes as $val)
                            @php $atts = \App\Models\Atribute::find($val); @endphp
                            <label class="btn btn-outline-secondary me-2">
                                <input type="radio" name="size" value="{{ $val }}" autocomplete="off">
                                {{ $atts->value ?? '' }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($product->color)
                @php $colors = explode(',', $product->color); @endphp
                <div class="mb-3">
                    <label class="form-label"><strong>Color</strong></label><br>
                    @foreach ($colors as $val)
                        @php $atts = \App\Models\Atribute::find($val); @endphp
                        <label class="me-2">
                            <input type="radio" name="color" value="{{ $val }}" class="form-check-input">
                            <span class="rounded-circle d-inline-block"
                                style="width: 20px; height: 20px; background:{{ $atts->value ?? '#ccc' }}"></span>
                        </label>
                    @endforeach
                </div>
            @endif

            <div class="row align-items-center mb-3">
                <div class="col-md-4">
                    <input type="number" name="quantity" class="form-control text-center" value="1"
                        min="1">
                </div>
                <div class="col-md-8">
                    <button class="btn btn-primary w-100">
                        <i class="fa fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </div>
            </div>
            {!! Form::close() !!}

            <div class="mt-3 text-muted small">
                <i class="fa fa-fire text-danger"></i> {{ rand(1, 10) }} sold in last
                {{ intval((strtotime(date('H:i')) - strtotime('03:00')) / 3600) }} hours
            </div>
        </div>
    </div>

    <hr class="my-4">

    <!-- Tabs -->
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="productTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc" role="tab">Description</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="spec-tab" data-toggle="tab" href="#spec" role="tab">Specification</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="desc" role="tabpanel">
            {!! $product->content ?? 'N/A' !!}
        </div>
        <div class="tab-pane fade" id="spec" role="tabpanel">
            {!! $product->specification ?? 'N/A' !!}
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('public') }}/asset/css/xzoom.css">

<script src="{{ asset('public') }}/asset/js/xzoom.min.js"></script>
<script src="{{ asset('public') }}/asset/js/setup.js"></script>
<script>
    $(document).ready(function() {
        $('.viewProductDetails').on('shown.bs.modal', function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 400,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    });
</script>
