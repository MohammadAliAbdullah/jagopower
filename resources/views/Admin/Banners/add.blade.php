@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Banner</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Banner</a></li>
                        <li class="breadcrumb-item active">Add Banner</li>
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
                    <div class="card card-info">
                        @include('Admin.include.message')
                        <!-- form start -->
                        {!! Form::open(['method'=>'POST','route'=>'madmin.banners.store','class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group row ">
                                        {!! Form::label('name', 'Type', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('type', ['Adsense' => 'Adsense','Image' => 'Image'],null,['class'=>'type form-control','id'=>'receiver','required']); !!}
                                        </div>
                                    </div>

                                    <div class="form-group row position">
                                        {!! Form::label('name', 'Banner Position', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('position', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'URL', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('url', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>

                                    

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Status', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('status', ['Active' => 'Active','Pending' => 'Pending'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
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
<script type="text/javascript">
        
    var image = '<div class="form-group row image_ban">\
                                        {!! Form::label("name", "Image", ["class" => "col-sm-4 col-form-label"]) !!}\
                                        <div class="col-sm-8">\
                                            {!! Form::file("images", ["class"=>"form-control","id"=>"receiver","required"]) !!}\
                                        </div>\
                                    </div>';
    var code = '<div class="form-group row code">\
                                        {!! Form::label("name", "Code", ["class" => "col-sm-4 col-form-label"]) !!}\
                                        <div class="col-sm-8">\
                                            {!! Form::textarea("code", null, ["class"=>"form-control","id"=>"receiver", "required", "rows" => 3]) !!}\
                                        </div>\
                                    </div>';

    $(document).ready(function(){
        $('.type').change(function(){
            if (this.value == 'Adsense') {
                var position = $('.position');
                var code_section = $('.image_ban');
                if (code_section.length > 0) {
                    code_section.remove()
                }
                position.after(code);
            }
            if (this.value == 'Image') {
                var position = $('.position');
                var image_ban_section = $('.code');
                if (image_ban_section.length > 0) {
                    image_ban_section.remove();
                }
                position.after(image);
            }
        });          
    });
</script>
@endsection
