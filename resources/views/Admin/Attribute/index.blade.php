@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Attributes
                        <a href="{{ route('madmin.attributes.create') }}" class="btn btn-primary">Attributes Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Attributes</a></li>
                        <li class="breadcrumb-item active">Attributes add</li>
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
                                    <th>Value</th>
{{--                                    <th>Images</th>--}}
                                    <th>Parent ID</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($attributes as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
{{--                                        <td>--}}
{{--                                            <img src="{{ asset('storage/admin/images/attributes/'.$value->images) }}" width="80" height="60">--}}
{{--                                        </td>--}}
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            {{ $value->value }}
                                        </td>

                                        <td>
                                            @if($value->parent_id !=0)
                                                {{ $value->attribute_parent->name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif

                                        </td>
                                        <td>{{ $value->created_at->diffForHumans() }} </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.attributes.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.attributes.destroy',$value->id]]) !!}
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
                            {{ $attributes->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
