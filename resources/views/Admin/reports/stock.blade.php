@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inventory
                        {{--                        <a href="#" class="btn btn-primary">Inventory Add</a>--}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inventory</a></li>
                        <li class="breadcrumb-item active">Inventory add</li>
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
{{--                    <div class="card">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                {!! Form::open(['method'=>'GET','route'=>'madmin.sales.reports']) !!}--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        {!! Form::date('start', null, ['class'=>'form-control','id'=>'receiver','required']) !!}--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        {!! Form::date('end', null, ['class'=>'form-control','id'=>'receiver','required']) !!}--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <button type="submit" class="btn btn-info">Search</button>--}}
{{--                                        <a href="{{ route('madmin.sales.reports') }}" class="btn btn-danger">Reset</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                {!! Form::close() !!}--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                        </div>--}}
                        <div class="row">
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $product }} </h3>
                                        <p>Total Product</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-dollar-sign"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $qty }}</h3>

                                        <p>Stock Qty</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $category }} </h3>
                                        <p>Total Category</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-dollar-sign"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $brand }} </h3>
                                        <p>Total Brand</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-dollar-sign"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                        </div>

                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    {{--                                    <th>Sized</th>--}}
                                    {{--                                    <th>Colored</th>--}}
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>QTY</th>
                                    {{--                                    <th>Purchase Price</th>--}}
                                    <th>Regular Price</th>
                                    <th>Sales Price</th>
                                </tr>
                                @foreach($stocks as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->product->title ?? 'N/A' }}</td>
                                        <td>
                                            <img src="{{ asset('public/images/product/'.$value->product->thumb ) }}" width="60" height="40"></td>
                                        {{--                                        <td>{{ $value->sku }}</td>--}}

                                        {{--                                        <td>--}}
                                        {{--                                            {{ $value->sized }}--}}
                                        {{--                                        </td>--}}
                                        {{--                                        <td>--}}
                                        {{--                                            {{ $value->colored }}--}}
                                        {{--                                        </td>--}}
                                        <td>
                                            {{ $value->product->category->title ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $value->product->brand->title ?? 'N/A' }}
                                        </td>
                                        <td>{{ $value->stock_qty ?? 0 }}</td>
                                        {{--                                        <td>{{ $value->purchase_price }}</td>--}}
                                        <td>{{ $value->ragular_price ?? 0 }} Tk</td>
                                        <td>{{ $value->sales_price ?? 0 }} Tk</td>
                                        {{--                                        <td>{{ $value->created_at->diffForHumans() }} </td>--}}

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 m-0 float-right">
                            {{ $stocks->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
