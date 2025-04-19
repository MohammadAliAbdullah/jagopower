@extends('admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">SMS Templete Add
                        <a href="{{ route('smstemplete.create') }}" class="btn btn-primary">SMS Templete Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SMS Templete</a></li>
                        <li class="breadcrumb-item active">SMS Templete add</li>
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

                        @include('admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>Subject</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($values as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->subject }}</td>
                                        <td>{{$value->content}}</td>
                                        <td>
                                            @if($value->status=='Active')
                                                <span class="bg bg-info p-2 rounded">
                                                    {{ $value->status }}
                                                </span>
                                            @else
                                                <span class="bg bg-danger p-2 rounded">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('smstemplete.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['smstemplete.destroy',$value->id]]) !!}
                                                    <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete')">X</button>
                                                    {!! Form::close() !!}

                                            </div>
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
