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
                        <span class="breadcrumb-title">Checkout</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <section class="main-section-area">
        <div class="container-fluid">
            @include('include.message')
            {!! Form::open(['method' => 'POST', 'url' => '/pay', 'class' => 'form-horizontal']) !!}
            <div class="row">
                <div class="col-md-5 col-sm-12 col-12 ">
                    <div class="product-area">
                        <h3>Shipping Address</h3>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('name', 'Phone', ['class' => 'col-form-label']) !!}
                                {!! Form::number('phone', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                {!! Form::label('name', 'District', ['class' => 'col-form-label']) !!}
                                {!! Form::select('city', ['0' => 'Select District'] + $districts, null, [
                                    'class' => 'form-control',
                                    'id' => 'district',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('name', 'Area', ['class' => 'col-form-label']) !!}
                                <select name="area" id="sub_cat" class="form-control input-sm">
                                    <option value="0"></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                {!! Form::label('name', 'Address', ['class' => 'col-form-label']) !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'receiver', 'rows' => 3]) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <img src="{{ asset('public/images/') }}/cod.jpg" class="img-fluid" width="60">
                                <label>
                                    <input id='watch-me' name='payment_method' value="cash_on_delivery" type='radio'
                                        checked />Check On Delivary
                                </label><br>
                                {{--													{!! Form::radio('payment_method', 'cash_on_delivery', true); !!} Check On Delivary <br> --}}
                                <img src="{{ asset('public/images/') }}/sslcommerz.jpg" class="img-fluid" width="60">
                                <label>{!! Form::radio('payment_method', 'ssl') !!} Online Payment</label><br>
                                {{--													{!! Form::radio('payment_method', 'wallet', true); !!} My Wallet<br> --}}
                                {{--													{!! Form::radio('payment_method', 'wallet',['id' => 'see-me']); !!} My Wallet<br> --}}
                                {{--													{!! Form::radio('payment_method', 'wallet',['id' => 'look-me']); !!} My Wallet<br> --}}
                                {{--													@foreach ($payments as $payment) --}}
                                {{--														<img src="https://topstories247.com/wp-content/uploads/2020/06/bKash-Logo.jpg" class="img-fluid" width="60"> --}}
                                {{--														<input id='see-me' name='payment_method' value="Bkash"  type='radio' /> Bkash<br> --}}
                                {{--													@endforeach --}}
                                <img src="{{ asset('public/images/') }}/bkash.jpg" class="img-fluid" width="60">
                                <label>
                                    <input id='see-me' name='payment_method' value="Bkash" type='radio' /> Bkash
                                </label><br>
                                <img src="{{ asset('public/images/') }}/rocket.png" class="img-fluid" width="60">
                                <label>
                                    <input id='look-me' name='payment_method' value="Rocket" type='radio' /> Rocket
                                </label><br>
                                <div id="show-me-two" style="display: none;">
                                    <div class="text-center mb-6">
                                        <img src="{{ asset('public/images/payment_qr_code.jpg') }}" alt="Bkash QR Code"
                                            class="img-fluid" style="max-width: 250px;">
                                    </div>
                                    <p class="text-center font-weight text-danger">
                                        দয়া করে আমাদের এই <strong>01976223330</strong> বিকাশ মার্চেন্ট নম্বরে
                                        <strong>{{ Cart::getSubTotal() }} টাকা</strong> পেমেন্ট করুন।
                                    </p>

                                    <div class="row justify-content-center">
                                        <div class="col-md-6 mb-3">
                                            {!! Form::number('bkashnumber', null, ['class' => 'form-control', 'placeholder' => 'আপনার বিকাশ নম্বর']) !!}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            {!! Form::number('transaction', null, [
                                                'class' => 'form-control',
                                                'placeholder' => 'লেনদেন নম্বর (Transaction ID)',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div id='show-me-three' style="display: none">
                                    দয়া করে আমাদের এই 017262233308 রকেট মার্চেন্ট নম্বর এ {{ Cart::getSubTotal() }} টাকা
                                    পেমেন্ট করুন।
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Form::number('rocket_number', null, ['class' => 'form-control', 'placeholder' => 'Your Rocket Number']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::number('rocket_transaction', null, ['class' => 'form-control', 'placeholder' => 'Transaction No']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--											<div class="form-group row"> --}}
                        {{--												<div class="col-sm-12"> --}}
                        {{--													{!! Form::radio('payment_method', 'cash_on_delivery', true); !!} Check On Delivary --}}
                        {{--													{!! Form::radio('payment_method', 'ssl', true); !!} SSLCommerz --}}
                        {{--													{!! Form::radio('payment_method', 'wallet', true); !!} My Wallet --}}
                        {{--												</div> --}}
                        {{--											</div> --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info text-right">Confirm Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-12 ">
                    <div class="product-area">
                        <table class="table table-striped table-hover table-bordered shop_table">
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-name">QTY</th>
                                    <th class="product-name">Price</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($cartCollection as $item)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->quantity }}
                                        </td>
                                        <td>
                                            {{ $item->price }}
                                        </td>

                                        <td class="product-total">
                                            <span
                                                class="woocommerce-Price-amount amount">TK.{{ $item->getPriceSum() }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td></td>
                                    <th colspan="2">Subtotal</th>

                                    <td>
                                        TK.{{ Cart::getSubTotal() }}
                                    </td>
                                </tr>

                                {{--												<tr class="cart-subtotal"> --}}
                                {{--													<td></td> --}}
                                {{--													<th colspan="2">Shipping charge</th> --}}

                                {{--													<td> --}}
                                {{--														<?php $condition = Cart::getCondition('transaction_fee'); ?> --}}
                                {{--														@if ($condition) --}}
                                {{--															TK. {{ $condition->getValue() }} --}}
                                {{--														@else --}}
                                {{--															TK. 0.00 --}}
                                {{--														@endif --}}
                                {{--													</td> --}}
                                {{--												</tr> --}}

                                <tr class="order-total">
                                    <td></td>
                                    <th colspan="2">Total</th>

                                    <td>
                                        <strong>
                                            TK.{{ Cart::getTotal() }}
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('style')
    <link href="{{ asset('public/asset/css') }}/checkout.css" rel="stylesheet" type="text/css">
@endsection
@section('script')
    <script>
        // var acc = document.getElementsByClassName("accordion");
        // var i;
        //
        // for (i = 0; i < acc.length; i++) {
        // 	acc[i].addEventListener("click", function() {
        // 		this.classList.toggle("active");
        // 		var panel = this.nextElementSibling;
        // 		if (panel.style.display === "block") {
        // 			panel.style.display = "none";
        // 		} else {
        // 			panel.style.display = "block";
        // 		}
        // 	});
        // };
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#district').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('areas') }}?parent_id=" + id,
                    success: function(res) {
                        if (res) {
                            $("#sub_cat").empty();
                            $("#sub_cat").append('<option>Select Area</option>');
                            $.each(res, function(key, value) {
                                $("#sub_cat").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {
                            $("#sub_cat").empty();
                        }
                    }
                });
            } else {
                $("#sub_cat").empty();
            }
        });


        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    {{--	<script id="myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script> --}}

    {{--	<script> var base_url = "{{ url('/') }}"; var csrf = "{{ csrf_token() }}"; </script> --}}

    {{--	<script src="{{ asset('public/concave/bkash.js') }}"></script> --}}

    <script type="text/javascript">
        {{-- $.ajaxSetup({ --}}
        {{--	headers: { --}}
        {{--		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') --}}
        {{--	} --}}
        {{-- }); --}}
        {{-- $("#district").change(function() --}}
        {{-- { --}}
        {{--	var district = $(this).val(); --}}
        {{--	alert(district); --}}
        {{--	$.ajax({ --}}
        {{--		url: '{{ route("transaction_fee") }}', --}}
        {{--		type:'POST', --}}
        {{--		data :{ district:district, token: '{{csrf_token()}}' } , --}}
        {{--		//dataType:'JSON', --}}
        {{--		success: function(responce){ --}}
        {{--			console.log(responce); --}}
        {{--			//location.reload(); --}}
        {{--		} --}}
        {{--	}); --}}
        {{-- }); --}}
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#watch-me").click(function() {
                $("#show-me:hidden").show('slow');
                $("#show-me-two").hide();
                $("#show-me-three").hide();
            });
            $("#watch-me").click(function() {
                if ($('watch-me').prop('checked') === false) {
                    $('#show-me').hide();
                }
            });

            $("#see-me").click(function() {
                $("#show-me-two:hidden").show('slow');
                $("#show-me").hide();
                $("#show-me-three").hide();
            });
            $("#see-me").click(function() {
                if ($('see-me-two').prop('checked') === false) {
                    $('#show-me-two').hide();
                }
            });

            $("#look-me").click(function() {
                $("#show-me-three:hidden").show('slow');
                $("#show-me").hide();
                $("#show-me-two").hide();
            });
            $("#look-me").click(function() {
                if ($('see-me-three').prop('checked') === false) {
                    $('#show-me-three').hide();
                }
            });

        });
    </script>
@endsection
