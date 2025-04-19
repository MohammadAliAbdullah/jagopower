@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Products
                        <a href="{{ route('madmin.products.create') }}" class="btn btn-primary">products Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">products</a></li>
                        <li class="breadcrumb-item active">products add</li>
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
                                    <th>Slug</th>
                                    <th>Thumb</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($products as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            {{ $value->slug }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('public/images/product/'.$value->thumb) }}" width="80" height="60">
                                        </td>
                                        <td>

                                            {{ $value->category->title ?? 'N/A' }} >
{{--                                            @if($value->sub_category_id!=NULL or $value->sub_category_id !=0)--}}
{{--                                                {{ $value->subcategory->title }}--}}
{{--                                            @else--}}
{{--                                                N/A--}}
{{--                                            @endif--}}
                                        </td>
                                        <td>{{ $value->brand->title ?? 'N/A' }}</td>
                                        <td>
                                            @if($value->status=='Active')
                                                <span class="bg bg-primary p-2" style="border-radius:10px;">
                                                    {{ $value->status }}
                                                </span>
                                            @else
                                                <span class="bg bg-danger p-2" style="border-radius:10px;">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $value->created_at->diffForHumans() }} </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.products.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.products.destroy',$value->id]]) !!}
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
                            {{ $products->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

