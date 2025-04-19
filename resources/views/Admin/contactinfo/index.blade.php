@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Contact Info
                        <a href="{{ route('madmin.contactinfo.create') }}" class="btn btn-primary">Contact Info Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Contact Info</a></li>
                        <li class="breadcrumb-item active">Contact Info add</li>
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
                                    <th>Name</th>
                                    <th>Hotline</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($basics as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->branch_name }}</td>
                                        <td>{{ $value->hotline }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.contactinfo.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
{{--                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.contactinfo.destroy',$value->id]]) !!}--}}
{{--                                                    <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete')">X</button>--}}
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
                            {{ $basics->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
