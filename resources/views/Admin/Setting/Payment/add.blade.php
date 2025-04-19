@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Add Payment Getway</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Payment Getway</a></li>
                        <li class="breadcrumb-item active">Add Payment Getway</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('Admin.include.message')
            <!-- form start -->
            {!! Form::open(['method'=>'POST','route'=>'madmin.paymentgetway.store','class'=>'form-horizontal', 'files'=>true]) !!}
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-info">
                            <div class="card-header">
                                Payment Getway
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('name', 'Payment Method', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Account No', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('account_no', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Logo', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-2">
                                                {!! Form::file('images', null, ['class'=>'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Content', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::textarea('contents', null, ['class'=>'form-control','id'=>'receiver', 'rows' => 3]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Key', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('key', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Secret', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('secret', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Instant Key', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('inst', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Type', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::select('type', ['Website' => 'Website','Account' => 'Account'],null,['class'=>'form-control','id'=>'receiver']); !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Status', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::select('status', ['Active' => 'Active','Disable' => 'Disable'],null,['class'=>'form-control','id'=>'receiver']); !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
            $('#summernote2').summernote();
            $('#summernote3').summernote();
        });
    </script>
@endsection
