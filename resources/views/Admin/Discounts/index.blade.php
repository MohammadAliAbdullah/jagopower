@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Discount
                        <a href="{{ route('madmin.discounts.create') }}" class="btn btn-primary">Discount Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Discont</a></li>
                        <li class="breadcrumb-item active">Discont add</li>
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
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>Enddate</th>
                                    <th>limit Quantity</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th width="250">Action</th>
                                </tr>
                                @foreach($discounts as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->discount_name }}</td>
                                        <td>{{ $value->start_date }}</td>
                                        <td>{{ $value->end_date }}</td>
                                        <td>{{ $value->limit_qty }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>
                                            @if($value->status=='Pending')
                                                <span class="bg bg-danger p-2 rounded">
                                                    {{ $value->status }}
                                                </span>
                                            @elseif($value->status=='Ongoing')
                                                <span class="bg bg-success p-2 rounded">
                                                    {{ $value->status }}
                                                </span>
                                            @else
                                                <span class="bg bg-success p-2 rounded">
                                                    {{ $value->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $value->created_at->diffForHumans() }} </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.discounts.show',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-eye"></i> </a>
                                                    <a href="{{route('madmin.discounts.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.discounts.destroy',$value->id]]) !!}
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
                            {{ $discounts->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
