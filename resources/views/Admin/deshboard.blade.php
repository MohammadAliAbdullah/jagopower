@extends('Admin.layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $category }}</h3>
                            <p>Total Category</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-fw fa-taxi"></i>
                        </div>
                        <a href="{{ route('madmin.categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $product }}</h3>
                            <p>Total Product</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-camera"></i>
                        </div>
                        <a href="{{ route('madmin.products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $customer }}</h3>

                            <p>Total Customer</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('madmin.customeradmin.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $order }}</h3>

                            <p>Total Order</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-lg-7 col-7">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="6">
                                        <h5>
                                            Recent Order
                                        </h5>
                                    </td>
                                </tr>
                                </thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Customer</th>

                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                                @foreach($orders as $orderss)
                                    <tr>
                                        <td>
                                            {{ $orderss->invoice_no }}
                                        </td>
                                        <td>
                                            {{ $orderss->customer->name }}<br>
                                            {{ $orderss->customer->phone }}
                                        </td>
                                        <td>
                                            {{ $orderss->total }} Tk
                                        </td>
                                        <td>
                                            @if($orderss->status=='Pending')
                                                <sapn class="bg bg-danger" style="padding: 5px; border-radius: 5px;">
                                                    {{ $orderss->status }}
                                                </sapn>
                                            @else
                                                <span class="bg bg-info"  style="padding: 5px; border-radius:5px;">
                                                {{ $orderss->status }}
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-5">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="6">
                                        <h5>
                                            Recent Added Product
                                        </h5>
                                    </td>
                                </tr>
                                </thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Product</th>
                                    <th>Category</th>



                                </tr>
                                @foreach($products as $prod)
                                    <tr>
                                        <td>{{ $prod->id }}</td>
                                        <td>{{ $prod->title }}</td>
                                        <td>
                                        
                                            {{ $prod->category->title }}
                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>



            </div>


            <!-- Main row -->
            <!-- <div class="row">

                <section class="col-lg-12 connectedSortable">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Sales
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">

                                <div class="chart tab-pane active" id="revenue-chart"
                                     style="position: relative; height: 400px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 400px;"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 400px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 400px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

                <section class="col-lg-5 connectedSortable" style="display: none;">

                    <div class="card bg-gradient-primary">

                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>

                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div id="sparkline-1"></div>
                                    <div class="text-white">Visitors</div>
                                </div>

                                <div class="col-4 text-center">
                                    <div id="sparkline-2"></div>
                                    <div class="text-white">Online</div>
                                </div>

                                <div class="col-4 text-center">
                                    <div id="sparkline-3"></div>
                                    <div class="text-white">Sales</div>
                                </div>

                            </div>

                        </div>
                    </div>


                </section>
        </div>-->
    </section>
@endsection
@section('script')

@endsection
