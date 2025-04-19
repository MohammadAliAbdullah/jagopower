@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Attribute</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('adminmenu') }}">Attribute</a></li>
                        <li class="breadcrumb-item active">Edit Attribute</li>
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
                        {!! Form::model($attribute, ['method'=>'PATCH','route'=>['madmin.attributes.update',$attribute->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">


                            <div class="form-group row">
                                {!! Form::label('name', 'Attribute Name', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Value', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('value', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                {!! Form::label('name', 'Parent Attribute', ['class' => 'col-sm-4 col-form-label']) !!}--}}
{{--                                <div class="col-sm-8">--}}
{{--                                   <img src="{{ asset('storage/admin/images/attributes/'.$attribute->images) }}" width="120" height="90">--}}
{{--                                </div>--}}

{{--                            </div>--}}

                            <div class="form-group row">
                                {!! Form::label('name', 'Parent Attribute', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('parent_id', ['0'=>'Select parent']+$parents,null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                {!! Form::label('name', 'Image', ['class' => 'col-sm-4 col-form-label']) !!}--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    {!! Form::file('image', ['class'=>'form-control','id'=>'receiver']) !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}


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
                <div class="col-md-3">
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="form-group row">
                                {!! Form::label('name', 'Color Code', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    <input type="text" class="form-control my-colorpicker1 colorpicker-element">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        //Colorpicker
        $('.my-colorpicker1').colorpicker();
    </script>
@endsection