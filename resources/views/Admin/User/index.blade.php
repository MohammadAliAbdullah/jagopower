@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Admin
                        <a href="{{ route('madmin.adminuser.create') }}" class="btn btn-primary">Admin Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Admin add</li>
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
                                    <th>Email</th>
{{--                                    <th>Role</th>--}}
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($values as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            {{ $value->email }}
                                        </td>
{{--                                        <td>--}}
{{--                                           {{ $value->role_id }}--}}
{{--                                        </td>--}}
                                        <td>{{ $value->status }}</td>
                                        <td>{{ date("d-m-Y", strtotime($value->created_at)) }}</td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.adminuser.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                @if($value->id !=1)
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.adminuser.destroy',$value->id]]) !!}
                                                    <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete, Delete with product')">X</button>
                                                    {!! Form::close() !!}
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
