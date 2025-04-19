@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tutorial(Beta)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tutorial</a></li>
                        <li class="breadcrumb-item active">Tutorial(Beta)</li>
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
                        <div class="card card-success">
                            <div class="card-header">
                               Tutorial
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($values as $value)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $value['video'] }}?rel=0" allowfullscreen></iframe>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $value['title'] }}</h5>
{{--                                                    <a href="{{ $value['link'] }}" class="btn btn-sm btn-primary">View Details</a>--}}
{{--                                                    <a href="tel:+8801941698614" class="btn btn-sm btn-danger">Buy Now</a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Payment Getway end -->

        </div>
    </section>
    <!-- /.content -->
@endsection
