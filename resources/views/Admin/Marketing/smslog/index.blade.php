@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">SMS Log Add

                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SMS Log</a></li>
                        <li class="breadcrumb-item active">SMS Log add</li>
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
                    <div class="card">
{{--                    <div class="card-header">--}}
{{--                        {{ Form::open(['route' => 'datacollect.data', 'method' => 'POST', 'id' => 's-form',])}}--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-2">--}}
{{--                                {!! Form::select('datacat_id',[' '=>'All Data']+$datacategoryid,null,['class'=>'form-control','id'=>'receiver','required']); !!}--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <input type="text" name="search" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2">--}}
{{--                                <button type="submit" class="btn btn-info">Search</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        {{ Form::close() }}--}}
{{--                    </div>--}}
{{--                    <div class="card-header">--}}
{{--                        {{ Form::open(['route' => 'madmin.download.data', 'method' => 'POST', 'id' => 's-form',])}}--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-2">--}}
{{--                                {!! Form::select('datacat_id',[' '=>'All Data']+$datacategoryid,null,['class'=>'form-control','id'=>'receiver','required']); !!}--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <input type="text" name="search" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2">--}}
{{--                                <button type="submit" class="btn btn-info">Download</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        {{ Form::close() }}--}}
{{--                    </div>--}}
                    <!-- /.card-header -->

                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>MessageID</th>
                                    <th>Subject</th>
                                    <th>Content</th>
                                    <th>Phone</th>
                                    <th>Delivary</th>
                                    <th>Status</th>
                                    <th>Date/Time</th>
                                </tr>
                                @foreach($values as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->message_id }}</td>
                                        <td>{{$value->subject }}</td>
                                        <td>{{$value->content}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>
                                            @if($value->delivary=='DELIVRD' OR $value->delivary=='SENT')
                                                <span class="bg bg-success p-2 rounded">
                                                    Deliverd
                                                </span>
                                            @elseif($value->delivary=='ACCEPTD')
                                                <span class="bg bg-warning p-2 rounded">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->status==0)
                                                <span class="bg bg-info p-2 rounded">
                                                    If request successful(Acceptd)
                                                </span>
                                            @elseif($value->status==1)
                                                <span class="bg bg-danger p-2 rounded">
                                                    If request failed (REJECTD)
                                                </span>
                                            @elseif($value->status==101)
                                                <span class="bg bg-danger p-2 rounded">
                                                    if internal server error occurs (REJECTD)
                                                </span>
                                            @elseif($value->status==114)
                                                <span class="bg bg-danger p-2 rounded">
                                                    If content not provided (REJECTD)
                                                </span>
                                            @elseif($value->status==108)
                                                <span class="bg bg-danger p-2 rounded">
                                                    If wrong password/ not provided (REJECTD)
                                                </span>
                                            @elseif($value->status==109)
                                                <span class="bg bg-danger p-2 rounded">
                                                    If user not provided/Deleted (REJECTD)
                                                </span>
                                            @else
                                                <span class="bg bg-danger p-2 rounded">
                                                    REJECTD
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ date("d-m-Y", strtotime($value->created_at)) }} /{{ date("H:i:s", strtotime($value->created_at)) }}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 m-0 float-right">
                            {{ $values->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
