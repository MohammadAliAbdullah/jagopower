@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">About Us
{{--                        <a href="{{ route('madmin.categories.create') }}" class="btn btn-primary">Category Add</a>--}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">About us</a></li>
                        <li class="breadcrumb-item active">About</li>
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
                                    <th>about_title</th>
                                    <th>content</th>
                                    <th>mission</th>
                                    <th>vision</th>
                                    <th>establistmet</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($categories as $value)
                                    <tr>
                                        <td>{{ $value->about_title }}</td>
                                        <td>
                                            {{ $value->content }}
                                        </td>
                                        <td>{{ $value->mission }}</td>
                                        <td>{{ $value->vision }}</td>
                                        <td>{{ $value->establistmet }}</td>
                                        <td>{{ $value->created_at->diffForHumans() }} </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.aboutadmin.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
{{--                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.categories.destroy',$value->id]]) !!}--}}
{{--                                                    <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete, Delete with product')">X</button>--}}
{{--                                                    {!! Form::close() !!}--}}

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
                            {{ $categories->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
