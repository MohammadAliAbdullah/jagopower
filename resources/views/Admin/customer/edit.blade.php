@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('madmin.customeradmin.index') }}">Customer</a></li>
                        <li class="breadcrumb-item active">Edit Customer</li>
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
                <div class="col-md-6">
                    <div class="card card-info">
                    {{--                <div class="card-header">--}}
                    {{--                    <h3 class="card-title">Horizontal Form</h3>--}}
                    {{--                </div>--}}
                    <!-- /.card-header -->
                    @include('Admin.include.message')
                    <!-- form start -->
                        {!! Form::model($customer, ['method'=>'PATCH','route'=>['madmin.customeradmin.update', $customer],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">


                            <div class="form-group row">
                                {!! Form::label('name', 'Name', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Phone', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::number('phone', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>


                            <div class="form-group row">
                                {!! Form::label('name', 'Email', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::email('email', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Address', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::textarea('address', null, ['class'=>'form-control','id'=>'receiver','rows'=>'3','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Password', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('password', null, ['class'=>'form-control','id'=>'exampleInputPassword1','required']) !!}
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                            <button type="submit" class="btn btn-info">Update</button>
                            <button  onclick="window.history.back()" class="btn btn-default float-right">Cancel</button>
                        </div>
                        <!-- /.card-footer -->
                        {!! Form::close() !!}

                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

@endsection
