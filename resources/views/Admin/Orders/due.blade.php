@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Due Sale
                        {{--                        <a href="{{ route('madmin.local-sale.create') }}" class="btn btn-primary">All Sale Add</a>--}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Sale</a></li>
                        <li class="breadcrumb-item active">Due Sale</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3 class="card-title">Condensed Full Width Table</h3>--}}
                    {{--                        </div>--}}
                    <!-- /.card-header -->

                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered table-responsive">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>Invoice</th>
                                    <th width="20%">Customer Information</th>
                                    <th width="30%">Product</th>
                                    <th>Order Details</th>
                                    <th>Date</th>
                                    <th class="10%">Action</th>
                                </tr>
                                @foreach($orders as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->invoice_no }}</td>
                                        <td>
                                            <b>Name:</b> {{ $value->customer->name }} </br>
                                            <b>Phone:</b> {{ $value->customer->phone }} </br>
                                            <b>Email:</b> {{ $value->customer->email }} </br>
                                            <b>Address:</b> {{ $value->customer->address }} </br>
                                        </td>
                                        <td>
                                            @php
                                                $products=\App\Models\OrderDetails::where('invoice_no',$value->invoice_no)->get();
                                            @endphp
                                            @foreach($products as $product)
                                                {{ $product->name }} <hr>
                                            @endforeach
                                        </td>
                                        <td>
                                            <b>Sub Total:</b> {{ $value->subtotal }} Tk</br>
                                            <b>Discount:</b> {{ $value->discount }} Tk</br>
                                            <b>Vat:</b> {{ $value->vat }} Tk</br>
                                            <b>Delivary Charge:</b> {{ $value->delivary_charge }} Tk</br>
                                            <b>Total:</b> {{ $value->total }} Tk
                                        </td>

                                        <td>
                                            {{ $value->created_at->diffForHumans() }}
                                            @if( $value->status=='Pending')
                                                <div class="bg bg-danger p-1">
                                                    Pending
                                                </div>
                                            @elseif( $value->status=='Processing')
                                                <div class="bg bg-warning p-1">
                                                    Processing
                                                </div>
                                            @elseif( $value->status=='Shipped')
                                                <div class="bg bg-info p-1">
                                                    Shipped
                                                </div>
                                            @else
                                                <div class="bg bg-success p-1">
                                                    Completed
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="row">
                                                {{--                                                    <a href="{{route('madmin.local-sale.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>--}}
                                                <a href="{{route('madmin.orderadmin.show',$value->id)}}" class="btn btn-info m-1"><i class="fa fa-eye"></i> </a>
                                                {!! Form::open(['method'=>'DELETE','route'=>['madmin.local-sale.destroy',$value->id]]) !!}
                                                <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete')">X</button>
                                                {!! Form::close() !!}

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 m-0 float-right">
                            {{ $orders->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

