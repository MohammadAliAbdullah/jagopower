@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">SEO Config
{{--                        <a href="{{ route('madmin.seoconfigs.create') }}" class="btn btn-primary">SEO Config Add</a>--}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SEO Config</a></li>
                        <li class="breadcrumb-item active">SEO Config add</li>
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
                                    <th>Title</th>
                                    <th>Keyword</th>
                                    <th>Description</th>
                                    <th>Google</th>
                                    <th>Bing</th>
                                    <th>Google Analytics</th>
                                    <th>Facebook</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($configs as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->meta_title }}</td>
                                        <td>
                                            {{ $value->meta_keyword }}
                                        </td>
                                        <td>{{ $value->meta_description }}</td>
                                        <td>{{ $value->google_webmaster }}</td>
                                        <td>{{ $value->bing_webmaster }}</td>
                                        <td>{{ $value->google_analytics }}</td>
                                        <td>{{ $value->facebook_id }}</td>
                                        
                                        <td>{{ $value->created_at->diffForHumans() }} </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.seoconfigs.edit',$value->id)}}" class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.seoconfigs.destroy',$value->id]]) !!}
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
                            {{ $configs->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
