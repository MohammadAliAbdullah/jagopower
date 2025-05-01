@extends('Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Order <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Order Details</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- main-section-area-start -->
    <section>

        <div class="main-section-area">
            <div class="container">
                {!! Form::open(['method'=>'GET','route'=>'track']) !!}
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Enter your invoice number..">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-warning">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                @if(isset($order))
                <div class="row">

                    <div class="col-md-12">
                        <div class="order-detailsbox">

                            <div class="ordertopinfo">
                                <h3>Order Id: {{ $order->invoice_no }}
                                    <a target="_blank" href="{{ route('mypanel.minvoice.index', $order->invoice_no) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-print"></i> PDF</a>
                                </h3>
                            </div>
                            <div class="statusbox">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <div class="singlestatus active">
                                            <div class="icon">
                                                <i class="fa fa-file-text"></i>
                                            </div>
                                            <h3>Order placed</h3>
                                        </div>
                                    </div>

                                    <div class="col-md-3 text-center">
                                        @if($order->status=='Processing' OR $order->status=='Shipped' OR $order->status=='Complete')
                                            <div class="singlestatus active">
                                                <div class="icon">
                                                    <i class="fa fa-calculator"></i>
                                                </div>
                                                <h3>Confirmed</h3>
                                            </div>
                                        @else
                                            <div class="singlestatus">
                                                <div class="icon">
                                                    <i class="fa fa-calculator"></i>
                                                </div>
                                                <h3>Confirmed</h3>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3 text-center">
                                        @if($order->status=='Shipped' OR $order->status=='Complete' )
                                            <div class="singlestatus active">
                                                <div class="icon">
                                                    <i class="fa fa-truck"></i>
                                                </div>
                                                <h3>Shipped</h3>
                                            </div>
                                        @else
                                            <div class="singlestatus">
                                                <div class="icon">
                                                    <i class="fa fa-truck"></i>
                                                </div>
                                                <h3>Shipped</h3>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3 text-center">
                                        @if($order->status=='Complete')
                                            <div class="singlestatus active">
                                                <div class="icon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                                <h3>Delivered</h3>
                                            </div>
                                        @else
                                            <div class="singlestatus">
                                                <div class="icon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                                <h3>Delivered</h3>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="paddingbox">
                                <div class="ctsummery" style="margin-bottom: 30px;">
                                    <h4>Order Summary</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td width="15%"><b>Order Code:</b></td>
                                                <td width="50%">83733</td>
                                                <td><b>Order date:</b></td>
                                                <td>
                                                    {{ date("d/m/Y", strtotime($order->created_at)) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Customer:</b></td>
                                                <td>
                                                    {{ $order->customer->name }}
                                                </td>
                                                <td><b>Order status:</b></td>
                                                <td>
                                                    @if($order->status=='Pending')
                                                        <span class="bg bg-danger p-2 text-white">
                                                     {{ $order->status }}
                                                    </span>
                                                    @elseif($order->status=='Processing')
                                                        <span class="bg bg-warning p-2 text-white">
                                                 {{ $order->status }}
                                                </span>
                                                    @elseif($order->status=='Shipped')
                                                        <span class="bg bg-info p-2 text-white">
                                                 {{ $order->status }}
                                                </span>
                                                    @elseif($order->status=='Complete')
                                                        <span class="bg bg-success p-2 text-white">
                                                 {{ $order->status }}
                                                </span>
                                                    @else
                                                        <span class="bg bg-dark p-2 text-white">
                                                     {{ $order->status }}
                                                    </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone:</b></td>
                                                <td>{{ $order->customer->phone }}</td>
                                                <td><b>Total order amount:</b></td>
                                                <td>
                                                    {{ number_format($order->total,2) }} Tk
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Shipping Details:</b></td>
                                                <td>
                                                    @php
                                                        $ship=json_decode($order->shipping_address, TRUE);

                                                    @endphp
                                                    {{ $ship['name'] }}<br>
                                                    {{ $ship['phone'] }}<br>
                                                    {{ $ship['address'] }},
                                                    {{ $ship['area'] }},
                                                    {{ $ship['city'] }}

                                                    {{--                                                    @foreach($ship as $val)--}}
                                                    {{--                                                        {{ $val }} <br>--}}
                                                    {{--                                                    @endforeach--}}
                                                </td>
                                                <td><b>Payment metdod:</b></td>
                                                <td>
                                                    {{ $order->payment_status }}
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="ctsummery">
                                            <h4>Order Details</h4>
                                            <div class="table-responsive">
                                                <table class="table table-active">
                                                    <tbody>
                                                    <tr>
                                                        <th>#</th>
                                                        <th width="50%">Product</th>
                                                        <th>QTY</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    @php
                                                        $sl=1;
                                                    @endphp
                                                    @foreach($orders as $value)
                                                        <tr>
                                                            <td>
                                                                {{ $sl }}
                                                            </td>
                                                            <td>
                                                                {{ $value->name }}
                                                            </td>
                                                            <td>
                                                                {{ $value->qty }}
                                                            </td>
                                                            <td>
                                                                {{ $value->price }} Tk
                                                            </td>
                                                            <td>
                                                                {{ $value->total }} Tk
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $sl++;
                                                        @endphp
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="ctsummery">
                                            <h4>Order Amount</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody><tr>
                                                        <td><b>Subtotal</b></td>
                                                        <td>
                                                            {{ $order->subtotal }} Tk
                                                        </td>
                                                    </tr>

                                                    {{--                                                    <tr>--}}
                                                    {{--                                                        <td><b>Discount</b></td>--}}
                                                    {{--                                                        <td>--}}
                                                    {{--                                                            0.00                                            $--}}
                                                    {{--                                                        </td>--}}
                                                    {{--                                                    </tr>--}}
                                                    {{--                                                    <tr>--}}
                                                    {{--                                                        <td><b>Shopping Discount</b></td>--}}
                                                    {{--                                                        <td>--}}
                                                    {{--                                                            0.00                                            $--}}
                                                    {{--                                                        </td>--}}
                                                    {{--                                                    </tr>--}}
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <th>
                                                            {{ $order->total }} Tk
                                                        </th>
                                                    </tr>

                                                    </tbody></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif


            </div>
        </div>

    </section>
@endsection
@section('style')
    <link href="{{ asset('public/asset/css') }}/order.css" rel="stylesheet" type="text/css">
@endsection