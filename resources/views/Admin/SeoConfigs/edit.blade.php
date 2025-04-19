@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit SEO Config</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">SEO Config</a></li>
                        <li class="breadcrumb-item active">Edit SEO Config</li>
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
                    {{--                <div class="card-header">--}}
                    {{--                    <h3 class="card-title">Horizontal Form</h3>--}}
                    {{--                </div>--}}
                    <!-- /.card-header -->
                    @include('Admin.include.message')
                    <!-- form start -->
                        {!! Form::model($config, ['method'=>'PATCH','route'=>['madmin.seoconfigs.update', $config->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">


                            <div class="form-group row">
                                {!! Form::label('name', 'Meta Title', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('meta_title', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>


                            <div class="form-group row">
                                {!! Form::label('name', 'Meta Keyword', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('meta_description', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Meta Keyword', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('meta_keyword', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Google Webmaster', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('google_webmaster', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                    <p>Get your google web master verification code at <a href="https://search.google.com/search-console/about">Google search console</a></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Bing Webmaster', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('bing_webmaster', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                    <p>Get your bing web master verification code at <a href="https://www.bing.com/webmasters/about">bing search console</a></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Yandex Webmaster', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('yindex_webmaster', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                    <p>Get your Yandex web master verification code at <a href="https://webmaster.yandex.com/welcome/">Yandex search console</a></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Google Analytics', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('google_analytics', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                    <p>Get your google analytics verification code at <a href="https://analytics.google.com/analytics/web/">Google analytics</a></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Facebook ID', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('facebook_id', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                    <p>Get your facebook link from  <a href="#">Facebook</a></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Facebook Pixel', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('facebook_pixel', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                    <p>Get your facebook pixel verification code at <a href="https://developers.facebook.com/docs/facebook-pixel/">facebook Pixel</a></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Tawk', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('tawk', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                    <p>Get your tawk verification code at <a href="https://www.tawk.to/">tawk</a></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Others', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('other_code', null, ['class'=>'form-control','id'=>'receiver']) !!}
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
