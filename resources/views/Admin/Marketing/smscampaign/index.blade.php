@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">SMS Campaign Add
                        <a href="{{ route('madmin.smscampaign.create') }}" class="btn btn-primary">SMS Campaign Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SMS Campaign</a></li>
                        <li class="breadcrumb-item active">SMS Campaign add</li>
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
                        <div class="card-header p-1">
                            <h3><b>Your SMS Balance: </b> {{ $blance }} Tk</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
{{--                                    <th>Type</th>--}}
                                    <th>Subject</th>
                                    <th>Content</th>
{{--                                    <th>Schedule</th>--}}
                                    <th>Job</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($values as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
{{--                                        <td>--}}
{{--                                            {{$value->type}}--}}
{{--                                        </td>--}}
                                        <td>{{$value->subject }}</td>
                                        <td>{{$value->content}}</td>
{{--                                        <td>{{$value->schedule}}</td>--}}
                                        <td>

                                            @if($value->send_status=='Send')
                                                <span class="bg bg-success p-2 rounded">
                                                   {{$value->send_status}}
                                                </span>
                                            @else
                                                <span class="bg bg-danger p-2 rounded">
                                                    {{$value->send_status}}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->status=='Instant')
                                                <span class="bg bg-info p-2 rounded">
                                                    {{ $value->status }}
                                                </span>
                                            @else
                                                <span class="bg bg-danger p-2 rounded">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                                <br>
                                                <br>
                                                <a href="{{url('/madmin/smssends')}}/{{ $value->id }}" class="btn btn-success m-1">Send </a>
                                        </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.smscampaign.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.smscampaign.destroy',$value->id]]) !!}
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
