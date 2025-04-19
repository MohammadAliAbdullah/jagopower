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
                    <div class="card">
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3 class="card-title">Condensed Full Width Table</h3>--}}
                    {{--                        </div>--}}
                    <!-- /.card-header -->

                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>Title</th>
{{--                                    <th>Image</th>--}}
{{--                                    <th>Sized</th>--}}
{{--                                    <th>Colored</th>--}}
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>QTY</th>
{{--                                    <th>Purchase Price</th>--}}
                                    <th>Regular Price</th>
                                    <th>Sales Price</th>
{{--                                    <th>Date</th>--}}
                                    <th>Action</th>
                                </tr>
                                @foreach($stocks as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->title ?? 'N/A' }}</td>
{{--                                        <td>--}}
{{--                                            <img src="{{ asset('public/images/product/'.$value->product->thumb ) }}" width="60" height="40"></td>--}}
{{--                                        <td>{{ $value->sku }}</td>--}}

{{--                                        <td>--}}
{{--                                            {{ $value->sized }}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {{ $value->colored }}--}}
{{--                                        </td>--}}
                                        <td>
                                            {{ $value->category->title ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $value->brand->title ?? 'N/A' }}
                                        </td>
                                        <td>{{ $value->productstock->qty ?? 0 }}</td>
{{--                                        <td>{{ $value->purchase_price }}</td>--}}
                                        <td>{{ $value->productstock->ragular_price ?? 0 }} Tk</td>
                                        <td>{{ $value->productstock->sales_price ?? 0 }} Tk</td>
{{--                                        <td>{{ $value->created_at->diffForHumans() }} </td>--}}

                                        <td>
                                            <div class="row">
                                                    <a href="#" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>

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
