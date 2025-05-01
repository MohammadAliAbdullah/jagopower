@extends('../Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">My Panel <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Account</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- main-section-area-start -->
    <section>

        <div class="main-section-area">
            <div class="container">
                @include('Mypanel.verification')
                <div class="row">
                    <div class="col-md-3">
                        @include('Mypanel.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="form-area">
                            <div class="form-area-head">
                                <h5>Your Order</h5>
                            </div>

                            <div class="anather2">
                                <!-- <div class="table-area"> -->
{{--                                <div class="d-flex">--}}
{{--                                    <div class="mr-auto showi-of-1-2">--}}
{{--                                        <p class="d-inline">Show</p>--}}

{{--                                        <select class="d-inline" id="inputState" class="form-control">--}}
{{--                                            <option selected>1</option>--}}
{{--                                            <option>2</option>--}}
{{--                                            <option>232</option>--}}
{{--                                        </select>--}}
{{--                                        <p class="d-inline">entire</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="order-top-search">--}}
{{--                                        <nav class="navbar navbar-light order-nav">--}}
{{--                                            <form class="form-inline">--}}
{{--                                                <button class="btn btn-outline-success search-btn22 " type="submit">Search</button>--}}
{{--                                                <input class="form-control " type="search" placeholder="" aria-label="Search">--}}
{{--                                            </form>--}}
{{--                                        </nav>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

                                <div class="form-area2">
                                    <table class="table table-striped">
                                        <tr>
                                            <th><span class="nibor"><b>Order</b></span></th>
                                            <th><span class="nibor"><b>Date</b></span></th>
                                            <th><span class="nibor"><b>Payment</b></span></th>
                                            <th><span class="nibor"><b>Status</b></span></th>

                                            <th><span class="nibor"><b>Action</b></span></th>
                                        </tr>
                                    @foreach($orders as $value)
                                        <tr>
                                            <td>
                                                #{{ $value->invoice_no }}
                                            </td>
                                            <td>
                                                {{ date("d/m/Y", strtotime($value->created_at)) }}
                                            </td>
                                            <td>
                                                {{ $value->payment_status }}
                                            </td>
                                            <td>
                                                @if($value->status=='Pending')
                                                    <span class="bg bg-danger p-2 text-white">
                                                     {{ $value->status }}
                                                    </span>
                                                @elseif($value->status=='Processing')
                                                    <span class="bg bg-warning p-2 text-white">
                                                 {{ $value->status }}
                                                </span>
                                                @elseif($value->status=='Shipped')
                                                    <span class="bg bg-info p-2 text-white">
                                                 {{ $value->status }}
                                                </span>
                                                @elseif($value->status=='Complete')
                                                    <span class="bg bg-success p-2 text-white">
                                                 {{ $value->status }}
                                                </span>
                                                @else
                                                    <span class="bg bg-dark p-2 text-white">
                                                     {{ $value->status }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('mypanel.morder.show',$value->invoice_no) }}" class="btn btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </table>
                                </div>
                                <!-- </div> -->

                                <div class="d-flex">

                                    <div class="">
                                        {{ $orders->render()  }}
                                    </div>

                                </div>




                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>

    </section>
@endsection
@section('style')
    <link href="{{ asset('public/asset/css') }}/order.css" rel="stylesheet" type="text/css">
@endsection