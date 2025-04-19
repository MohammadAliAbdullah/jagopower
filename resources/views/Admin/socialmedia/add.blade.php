@extends('admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Social Media Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('madmin.socialmedia.index') }}">  Social Media Info</a></li>
                        <li class="breadcrumb-item active">Add  Social Media Info</li>
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
                        {!! Form::open(['method'=>'POST','route'=>'madmin.socialmedia.store','class'=>'form-horizontal','files'=>true]) !!}
                        <div class="card-body">

                            <div class="form-group row">
                                {!! Form::label('name', 'Company', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('basicinfo_id', $companys,null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Facebook', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('facebook', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Twitter', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('twitter', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Linkedin', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('linkedin', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Instragram', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('instagram', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Youtube', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('youtube', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Tiktak', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('tiktak', null, ['class'=>'form-control','id'=>'receiver']) !!}
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
    <script type="text/javascript">
        $('#training').change(function(){
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('getTrainingList')}}?parent_id="+countryID,
                    success:function(res){
                        if(res){

                            $.each(res,function(key){
                                //console.log(res);
                                $('#amount').val(res)
                            });

                        }else{
                            $("#amount").empty();
                        }
                    }
                });
            }else{
                $("#amount").empty();
            }
        });

        $('#getway').change(function(){
            var countryIDd = $(this).val();
            if(countryIDd){
                $.ajax({
                    type:"GET",
                    url:"{{url('getGetwayList')}}?parent_id="+countryIDd,
                    success:function(res){
                        if(res){

                            $.each(res,function(key){
                                //console.log(res);
                                $('#receiver').val(res)
                            });

                        }else{
                            $("#receiver").empty();
                        }
                    }
                });
            }else{
                $("#receiver").empty();
            }
        });
    </script>
@endsection
