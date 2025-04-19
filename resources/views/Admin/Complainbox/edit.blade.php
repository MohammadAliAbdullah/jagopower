@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Complain</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Complain</a></li>
                        <li class="breadcrumb-item active">Edit Complain</li>
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
                        {!! Form::model($edits, ['method'=>'PATCH','route'=> ['madmin.complainadmin.update', $edits->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('name', 'Phone', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('phone', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Email', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('email', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Subject', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('subject', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Complain', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('complain', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>5]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Image', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::file('attachment', ['class'=>'','id'=>'receiver']) !!}
                                            </div>
                                            <div class="col-sm-4">
                                                <img src="{{ asset('public/images/complain') }}/{{ $edits->attachment }}" alt="" width="80">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            {!! Form::label('name', 'Status', ['class' => 'col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('status', ['Complete' => 'Complete','Pending' => 'Pending'],null,['class'=>'','id'=>'receiver','required']); !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
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
