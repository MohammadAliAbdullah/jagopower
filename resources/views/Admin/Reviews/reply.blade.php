@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Reply</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Reply</a></li>
                        <li class="breadcrumb-item active">Add Reply</li>
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
                    {{--                <div class="card-header">--}}
                    {{--                    <h3 class="card-title">Horizontal Form</h3>--}}
                    {{--                </div>--}}
                    <!-- /.card-header -->
                    @include('Admin.include.message')
                    <!-- form start -->
                        {!! Form::open(['method'=>'POST','route'=>['madmin.reply_store', ['review_id' => $review->id, 'customer_id' => $review->customer_id, 'admin_id' => $review->admin_id]],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">

                            <div class="form-group row">
                                {!! Form::label('name', 'Write a reply:', ['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-6">
                                    {!! Form::textarea('content',  $review_reply ? $review_reply->content : '' , ['class'=>'form-control', 'rows' => 3, 'id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Status', ['class' => 'col-sm-2']) !!}
                                <div class="col-sm-6">
                                    {!! Form::select('status', ['Pending' => 'Pending', 'Active' => 'Active'],null,['class'=>'','id'=>'receiver','required']); !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Type', ['class' => 'col-sm-2']) !!}
                                <div class="col-sm-6">
                                    {!! Form::select('type', ['Formal' => 'Formal', 'Technical' => 'Technical'],null,['class'=>'','id'=>'receiver','required']); !!}
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
