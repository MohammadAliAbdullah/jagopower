@extends('admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Adjustment
{{--                        <a href="{{ route('madmin.adjustment.add') }}" class="btn btn-primary">Adjustment Add</a>--}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Adjustment</a></li>
                        <li class="breadcrumb-item active">Adjustment add</li>
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
                    <div class="card-header">
                        {!! Form::open(['method'=>'GET','route'=>'madmin.stock.adjustment']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::text('search', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.card-header -->

                        @include('admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>Product</th>
                                    <th>Stock Qty</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($values as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->product->title }}</td>
                                        <td>
                                            {{ $value->stock_qty }}
                                        </td>
                                        <td>{{ $value->sales_price }}Tk</td>
                                        <td>{{ $value->created_at->diffForHumans() }} </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{ route('madmin.adjustment.edit', ['id' => $value->id]) }}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>

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
                            {{ $values->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
