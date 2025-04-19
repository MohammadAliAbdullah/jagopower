@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Store(Beta)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Store</a></li>
                        <li class="breadcrumb-item active">Store(Beta)</li>
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
            @foreach($types as $type)
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            {{ $type['title'] }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php
                                $values=$types = json_decode(file_get_contents('https://marketinghelplines.com/crm/api/ecommerceshop/'.$type['id']), true);
                                @endphp
                                @foreach($values as $value)
                                <div class="col-md-3">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ $value['image_url'] }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $value['title'] }}</h5>
                                            <p class="card-text"><del>{{ $value['price'] }}Tk</del> {{ $value['sales_price'] }}Tk</p>
                                            <a href="{{ $value['link'] }}" class="btn btn-sm btn-primary">View Details</a>
                                            <a href="tel:+8801941698614" class="btn btn-sm btn-danger">Buy Now</a>
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
            @endforeach
        </div>
    </section>
    <!-- /.content -->
@endsection
