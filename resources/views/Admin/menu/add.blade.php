@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Menu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Menu</a></li>
                        <li class="breadcrumb-item active">Add Menu</li>
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
                        {!! Form::open(['method'=>'POST','route'=>'madmin.adminmenu.store','class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">


                            <div class="form-group row">
                                {!! Form::label('name', 'Title', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Parent', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('parent_id', ['0'=>'Select parent']+$menus,null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'URL', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('url', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Icon', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('icon', 'fas fa-angle-right', ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Orders', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::number('orders', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Status', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('status', ['Active' => 'Active','Pending' => 'Pending'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                            <button type="submit" class="btn btn-info">Submit</button>
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
