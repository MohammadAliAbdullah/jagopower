@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Page</a></li>
                        <li class="breadcrumb-item active">Edit Page</li>
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
                        {!! Form::model($page, ['method'=>'PATCH','route'=>['madmin.pages.update', $page->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Blog Title', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('title', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Image', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::file('images', ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Content', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'summernote','required']) !!}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        {!! Form::label('name', 'Status', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('status', ['Active' => 'Active','Pending' => 'Pending'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Meta Title', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('meta_title', $page->seometa->meta_title, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Meta Keyword', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('meta_keyword', $page->seometa->meta_keyword, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Meta Description', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('meta_description', $page->seometa->meta_description, ['class'=>'form-control','id'=>'receiver','required']) !!}
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
    $(document).ready(function() {
      $('#summernote').summernote();
    });
</script>
@endsection
