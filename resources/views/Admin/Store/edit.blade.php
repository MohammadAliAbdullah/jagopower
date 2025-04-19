@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Category</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
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
         {!! Form::model($category, ['method'=>'PATCH','route'=> ['madmin.categories.update', $category->id],'class'=>'form-horizontal', 'files'=>true]) !!}
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Category Title', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::text('title', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Main Category', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-4">
                                            {!! Form::select('parent_id', ['0'=>'Select Parent']+$parents,null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Content', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'summernote', 'rows' => 6]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card card-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center lead">SEO Information</p>
                                        <div class="form-group row">
                                            {!! Form::label('name', 'Meta Title', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('meta_title', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Meta Keyword', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::textarea('meta_keyword', null, ['class'=>'form-control','id'=>'receiver', 'rows' => 1]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Meta Description', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::textarea('meta_description', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>1]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('name', 'Meta Schema', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::textarea('schema', null, ['class'=>'form-control','id'=>'receiver','rows'=>3,]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Search Engine Follow', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::select('follow', ['Yes' => 'Yes','No' => 'No'],null,['class'=>'form-control','id'=>'receiver']); !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Social Media Images', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-2">
                                                {!! Form::file('smm_images', null, ['class'=>'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Social Media  Title', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::text('smm_title', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('name', 'Social Media  Description', ['class' => 'col-sm-12 col-form-label']) !!}
                                            <div class="col-sm-12">
                                                {!! Form::textarea('smm_content', null, ['class'=>'form-control','id'=>'receiver','rows'=>3]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="form-group row">
                                {!! Form::label('name', 'Type', ['class' => 'col-sm-12']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('type', ['Regular' => 'Regular Category','Special' => 'Special Category'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Image', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::file('image', ['class'=>'','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Images Alt', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::text('img_alt', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Banner', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::file('banner', ['class'=>'','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Status', ['class' => 'col-sm-12']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('status', ['Active' => 'Active','Pending' => 'Pending'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-info btn-block">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

            <!-- /.row (main row) -->
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
