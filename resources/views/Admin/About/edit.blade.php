@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit About Us</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">About Us</a></li>
                        <li class="breadcrumb-item active">Edit About Us</li>
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
                <div class="col-md-10">
                    <div class="card card-info">
                        @include('Admin.include.message')
                        <!-- form start -->
                        {!! Form::model($category, ['method'=>'PATCH','route'=> ['madmin.aboutadmin.update', $category->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('name', 'About Title', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('about_title', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'About Us', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>5]) !!}
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            {!! Form::label('name', 'Mission', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('mission', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>3]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Vision', ['class' => 'col-sm-2']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('vision', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>3]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Establistmet', ['class' => 'col-sm-2']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('establistmet', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>3]) !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                            <button  onclick="window.history.back()" class="btn btn-default float-right">Cancel</button>
                        </div>
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
