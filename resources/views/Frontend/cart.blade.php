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
                        <span class="breadcrumb-title">Cart</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <section class="cartbg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th class="algimg">Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">

                            @foreach ($cartCollection as $item)
                                <input type="hidden" class="item_id" value="{{ $item->id }}">
                                <tr class="table-bordered">
                                    <td class="align-middle">
                                        {{ $item->name }}
                                    </td>
                                    <td class="align-middle algimg">
                                        <img src="{{ asset('public/images/product/' . $item->attributes['image']) }}"
                                            alt="" style="width: 50px;">
                                    </td>
                                    <td class="align-middle">Tk {{ $item->price ?? 0 }}</td>
                                    <td class="align-middle">
                                        {!! Form::open(['method' => 'POST', 'route' => 'update.cart']) !!}
                                        <div class="input-group cartt">
                                            <input type="hidden" value="{{ $item->id }}" class="form-control id"
                                                name="id" />
                                            <input type="number" value="{{ $item->quantity }}" class="form-control"
                                                id="quantity" name="quantity" />
                                            <button type="submit" class="btn btn-warning btn-block catbtn">Update</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="align-middle">Tk {{ $item->getPriceSum() }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-sm btn-danger"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        {{--								<button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <a class="btn btn-block btn-info font-weight-bold cshoping" href="{{ url('/') }}">
                                        <i class="fa fa-arrow-alt-circle-left"></i>
                                        Continue Shopping
                                    </a>
                                </td>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="sidebarcart">
                        <h5>Payment Summary</h5>
                        <div class="cartcheck">
                            <div class="border-bottom pb-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6>Subtotal</h6>
                                    <h6>Tk {{ Cart::getSubTotal() }}</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Discount</h6>
                                    <h6 class="font-weight-medium">Tk 0</h6>
                                </div>
                            </div>
                            <div class="pt-2">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5>Total</h5>
                                    <h5>Tk {{ Cart::getTotal() }}</h5>
                                </div>
                                <a class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                                    href="{{ route('checkout') }}">Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>

                    {{--					<div class="sidebarcart"> --}}
                    {{--						<form action=""> --}}
                    {{--							<div class="input-group"> --}}
                    {{--								<input type="text" class="form-control border-0" placeholder="Enter Coupon Code"> --}}
                    {{--								<div class="input-group-append"> --}}
                    {{--									<button class="btn btn-primary">Apply</button> --}}
                    {{--								</div> --}}
                    {{--							</div> --}}
                    {{--						</form> --}}
                    {{--					</div> --}}

                </div>
                <!-- paymnt -->

            </div>
        </div>
    </section>
    <!-- Cart End -->
@endsection

@section('style')
    <link href="{{ asset('public/asset') }}/css/cart.css" rel="stylesheet">
    <style type="text/css">
        .cart tr td a img {
            height: 50px;
            width: 50px;
        }
    </style>
@endsection

@section('script')
@endsection
