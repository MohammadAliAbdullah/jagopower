@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Servicing Box
                        <a href="{{ route('madmin.servicing.create') }}" class="btn btn-primary">Servicing Box Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Servicing Box</a></li>
                        <li class="breadcrumb-item active">Servicing Box add</li>
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
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3 class="card-title">Condensed Full Width Table</h3>--}}
                    {{--                        </div>--}}
                    <!-- /.card-header -->

                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>Customer Info</th>
                                    <th>Complain</th>
                                    <th>Solution</th>
                                    <th>Other</th>
                                    <th>Status</th>
{{--                                    <th>Date</th>--}}
                                    <th>Action</th>
                                </tr>
                                @foreach($services as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            <b>Name:</b> {{ $value->customer->name }}<br>
                                            <b>Phone:</b>
                                            @if($value->phone==NULL)
                                                {{ $value->customer->phone }}
                                            @else
                                                {{ $value->phone }}
                                            @endif
                                            <br>
                                            <b>Address:</b>
                                            @if($value->phone==NULL)
                                                {{ $value->customer->address }}
                                            @else
                                                {{ $value->address }}
                                            @endif
                                            <br>
                                        </td>
                                        <td>{{ $value->complain }}</td>
                                        <td>{{ $value->solution }}</td>
                                        <td>
                                            <b>Technician: </b> {{ $value->technician }}<br>
                                            <b>Date: </b> {{ $value->date }}<br>
                                            <b>Amount: </b> {{ $value->amount }}<br>
                                        </td>
                                        <td>
                                            @if($value->status=='Pending')
                                                <div class="bg-warning p-1">
                                                    {{ $value->status }}
                                                </div>
                                            @else
                                                <div class="bg-success p-1">
                                                    {{ $value->status }}
                                                </div>
                                            @endif
                                        </td>
{{--                                        <td>{{ $value->created_at->diffForHumans() }} </td>--}}

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.servicing.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.servicing.destroy',$value->id]]) !!}
                                                    <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete, Delete with product')">X</button>
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
                            {{ $services->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
