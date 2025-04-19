@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payment Getway
                        <a href="{{ route('madmin.paymentgetway.create') }}" class="btn btn-primary">Payment Getway Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Payment Getway</a></li>
                        <li class="breadcrumb-item active">Payment Getway add</li>
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
                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>Method</th>
                                    <th>AccountNo</th>
                                    <th>Logo</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($values as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name ?? 'N/A' }}</td>
                                        <td>{{ $value->account_no ?? 'N/A' }}</td>
                                        <td>
                                            @if($value->images!=NULL)
                                                <img src="{{ asset('public/payment/'.$value->images) }}" width="80" height="60">
                                            @else
                                                <img src="{{ asset('public/admin/notfind.png') }}" width="80" height="60">
                                            @endif
                                        </td>
                                        <td>{{ $value->type ?? 'N/A' }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>{{ $value->created_at->diffForHumans() }} </td>
                                        <td>
                                            <div class="row">
                                                <a href="{{route('madmin.paymentgetway.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                {!! Form::open(['method'=>'DELETE','route'=>['madmin.paymentgetway.destroy',$value->id]]) !!}
                                                <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete, Delete with product')">X</button>
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