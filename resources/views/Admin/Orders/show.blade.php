@extends('Admin.layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
{{--                <div class="col-md-6">--}}
{{--                    <div class="callout callout-info">--}}
{{--                        {!! Form::open(['method'=>'POST','route'=>'madmin.orderadmin.store']) !!}--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-5">--}}
{{--                                <h4>Payment Status</h4>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-5">--}}
{{--                                <select class="form-control" name="payment_status">--}}
{{--                                    <option value="">Payment Status</option>--}}
{{--                                    <option value="Pending">Pending</option>--}}
{{--                                    <option value="Done">Done</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2">--}}
{{--                                <button type="submit" class="btn btn-info">Submit</button>--}}
{{--                            </div>--}}
{{--                            <input type="hidden" name="id" value="{{ $order->id }}">--}}
{{--                        </div>--}}
{{--                        {!! Form::close() !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-6">
                    <div class="callout callout-info">
                        {!! Form::open(['method'=>'POST','route'=>'madmin.orderadmin.store']) !!}
                        <div class="row">
                            <div class="col-md-5">
                                <h4>Order Status</h4>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control" name="status">
                                    <option value="">Order Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="id" value="{{ $order->id }}">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-6">
                    <div class="callout callout-info">
                        {{--                        <a href="" class="btn btn-dark text-white"><i class="fa fa-money-bill"></i> Add Payment</a>--}}
                        {{--                        <a href="" class="btn btn-info text-white"><i class="fa fa-print"></i> Invoice Print(POS)</a>--}}
                        <a href="{{route('madmin.invoicea4.index',$order->invoice_no)}}" target="_blank" class="btn btn-success text-white">
                            <i class="fa fa-print"></i> Invoice Print
                        </a>
{{--                        <a href="{{route('madmin.invoicea4photo.index',$order->invoice_no)}}" class="btn btn-warning text-white"><i class="fa fa-print"></i> Invoice Print(A4/Photo)</a>--}}
                        <a href="{{route('madmin.chalan.index',$order->invoice_no)}}" class="btn btn-danger text-white"><i class="fa fa-print"></i> Challan Print</a>
                    </div>
                </div>
                <div class="col-12">

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Invoice #{{ $order->invoice_no }}
                                    <small class="float-right">Date: {{ date("d-m-Y", strtotime($order->created_at)) }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Billing Details
                                <address>
                                    <strong>{{ $order->customer->name }}</strong><br>
{{--                                    {{ $order->customer->address }}<br>--}}
                                    <b>Phone:</b> {{ $order->customer->phone }}<br>
                                    <b>Email:</b> {{ $order->customer->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Shipping Details
                                <address>
                                    @php
                                        $ship=json_decode($order->shipping_address, TRUE);

                                    @endphp
                                    <strong>{{ $ship['name'] }}</strong><br>
                                    <b>Address: </b>{{ $ship['address'] }},
                                    {{ $ship['area'] }},
                                    {{ $ship['city'] }}<br>
                                    <b>Phone: </b> {{ $ship['phone'] }}<br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{ $order->invoice_no }}</b><br>
                                <b>Payment Method: </b> {{ $order->payment_type }} <br>
                                <b>Payment Status: </b> {{ $order->payment_status }} <br>
                                <b>Status #
                                    @if( $order->status=='Pending')
                                        <span class="bg bg-danger p-1 text-center" style="width: 100px; border-radius: 10px">
                                            Pending
                                        </span>
                                    @elseif( $order->status=='Processing')
                                        <span class="bg bg-warning p-1 text-center" style="width: 100px; border-radius: 10px">
                                            Processing
                                        </span>
                                    @elseif( $order->status=='Shipped')
                                        <span class="bg bg-info p-1 text-center" style="width: 100px; border-radius: 10px">
                                            Shipped
                                        </span>
                                    @else
                                        <span class="bg bg-success p-1 text-center" style="width: 100px; border-radius: 10px">
                                            Completed
                                        </span>
                                    @endif
                                </b><br>
                                <br>
{{--                                <b>Order ID:</b> 4F3S8J<br>--}}
{{--                                <b>Payment Due:</b> 2/22/2014<br>--}}
{{--                                <b>Account:</b> 968-34567--}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Photo</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $orderdts=\App\Models\OrderDetails::where('order_id', $order->id)->get();
                                    $sl=1;
                                    @endphp
                                    @foreach($orderdts as $value)
                                    <tr>
                                        <td>
                                            {{ $sl }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('public/images/product') }}/{{ $value->product->thumb ?? 'N/A' }}" alt="" width="40">
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->qty }}</td>
                                        <td>{{ $value->price }}</td>
                                        <td>{{ $value->total }}</td>
                                    </tr>
                                      @php
                                      $sl++;
                                      @endphp
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-8">
{{--                                <p class="lead">Payment Methods:</p>--}}
{{--                                <img src="../../dist/img/credit/visa.png" alt="Visa">--}}
{{--                                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">--}}
{{--                                <img src="../../dist/img/credit/american-express.png" alt="American Express">--}}
{{--                                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">--}}

{{--                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">--}}
{{--                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem--}}
{{--                                    plugg--}}
{{--                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
{{--                                </p>--}}
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
{{--                                <p class="lead">Amount Due 2/22/2014</p>--}}

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>{{ $order->subtotal }} Tk</td>
                                        </tr>
                                        <tr>
                                            <th>Discount</th>
                                            <td>{{ $order->discount }} Tk</td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            <th>Tax (0%)</th>--}}
{{--                                            <td>{{ $order->vat }} Tk</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Shipping Charge:</th>--}}
{{--                                            <td>{{ $order->delivary_charge }} Tk</td>--}}
{{--                                        </tr>--}}
                                        <tr>
                                            <th>Total:</th>
                                            <td>{{ $order->total }} Tk</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
{{--                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>--}}
{{--                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit--}}
{{--                                    Payment--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
{{--                                    <i class="fas fa-download"></i> Generate PDF--}}
{{--                                </button>--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
