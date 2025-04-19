@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit SMS Campaign</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('madmin/smscampaign') }}">SMS Campaign</a></li>
                        <li class="breadcrumb-item active">Edit SMS Campaign</li>
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
                <div class="col-md-8">
                    <div class="card card-info">
                    {{--                <div class="card-header">--}}
                    {{--                    <h3 class="card-title">Horizontal Form</h3>--}}
                    {{--                </div>--}}
                    <!-- /.card-header -->
                    @include('Admin.include.message')
                    <!-- form start -->
                        {!! Form::model($value, ['method'=>'PATCH','route'=>['madmin.smscampaign.update',$value->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">
{{--                            <div class="form-group row">--}}
{{--                                {!! Form::label('name', 'type', ['class' => 'col-sm-4 col-form-label']) !!}--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    {!! Form::select('type',['Client'=>'Client','Newsletter'=>'Newsletter'],null,['class'=>'form-control','id'=>'receiver','required']); !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row">
                                {!! Form::label('name', 'Subject', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('subject', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Message', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'message', 'rows' => 5]) !!}
                                    <div id="counter"></div>
                                </div>
                            </div>

                            {{--                            <div class="form-group row">--}}
                            {{--                                {!! Form::label('name', 'Schdule', ['class' => 'col-sm-4 col-form-label']) !!}--}}
                            {{--                                <div class="col-sm-8">--}}
                            {{--                                    {!! Form::text('schedule',  null, ['class'=>'form-control','id'=>'datepicker']) !!}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="form-group row">
                                {!! Form::label('name', 'Status', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('status', ['Pending'=>'Pending'],null,['class'=>'form-control']); !!}
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
    <script type="text/javascript">
        const messageEle = document.getElementById('message');
        const counterEle = document.getElementById('counter');

        messageEle.addEventListener('input', function (e) {
            const target = e.target;

            // Get the `maxlength` attribute
            const maxLength = target.getAttribute('maxlength');

            // Count the current number of characters
            const currentLength = target.value.length;

            counterEle.innerHTML = `${currentLength} Char/${currentLength/160} SMS`;
            //counterEle.innerHTML = `${currentLength}/${maxLength}/${currentLength/160}`;
        });
    </script>
@endsection
