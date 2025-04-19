@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Servicing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Servicing</a></li>
                        <li class="breadcrumb-item active">Edit Servicing</li>
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
                        {!! Form::model($service, ['method'=>'PATCH','route'=> ['madmin.servicing.update', $service->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('name', 'Customer', ['class' => 'col-sm-2']) !!}
                                            <div class="col-sm-8">
                                                {!! Form::select('customer_id', ['0' => 'Select Customer']+$customers,null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                            </div>
                                        </div>

                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver','required']) !!}--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        {!! Form::label('name', 'Phone', ['class' => 'col-sm-2 col-form-label']) !!}--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            {!! Form::text('phone', null, ['class'=>'form-control','id'=>'receiver']) !!}--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}

                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        {!! Form::label('name', 'Address', ['class' => 'col-sm-2 col-form-label']) !!}--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            {!! Form::text('address', null, ['class'=>'form-control','id'=>'receiver']) !!}--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Complain', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('complain', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>5]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Solution', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::textarea('solution', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>5]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Product Model', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::text('product_model', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                            {!! Form::label('name', 'Technician', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::text('technician', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            {!! Form::label('name', 'Amount', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::text('amount', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                            {!! Form::label('name', 'Date', ['class' => 'col-sm-2 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::date('date', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {!! Form::label('name', 'Status', ['class' => 'col-sm-2']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::select('status', ['Complete' => 'Complete','Pending' => 'Pending','Ongoing' => 'Ongoing'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
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
