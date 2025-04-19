@extends('../Frontend.Layout.master')

@section('content')
    <!-- main-section-area-start -->
    <section>

        <div class="main-section-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Form-my-account</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="hello-omor">
                            <p>Hello ! <b>Omor Faruk</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat atque, minima modi error quasi</p>
                        </div>
                    </div>
                </div>

                <!-- Terms-Condition-area-start -->

                <!-- <div class="faq-area">
                    <h3>Frequently Asked Questions</h3>

                    <p>Last Updated on Jun 02, 2017</p>
                </div> -->

                <!-- Terms-Condition-area-end -->

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
                                <div class="d-flex">
                                    <div class="mr-auto showi-of-1-2">
                                        <p class="d-inline">Show</p>

                                        <select class="d-inline" id="inputState" class="form-control">
                                            <option selected>1</option>
                                            <option>2</option>
                                            <option>232</option>
                                        </select>
                                        <p class="d-inline">entire</p>
                                    </div>
                                    <div class="order-top-search">
                                        <nav class="navbar navbar-light order-nav">
                                            <form class="form-inline">
                                                <button class="btn btn-outline-success search-btn22 " type="submit">Search</button>
                                                <input class="form-control " type="search" placeholder="" aria-label="Search">
                                            </form>
                                        </nav>
                                    </div>

                                </div>

                                <div class="form-area2">
                                    <table class="table">
                                        <tr>
                                            <th><span class="nibor"><b>Order</b></span></th>
                                            <th><span class="nibor"><b>Date</b></span></th>
                                            <th><span class="nibor"><b>Status</b></span></th>
                                            <th><span class="nibor"><b>Total item</b></span></th>
                                            <th><span class="nibor"><b>Action</b></span></th>
                                        </tr>

                                        <tr>
                                            <td><span class="">#100561</span></td>
                                            <td><span class="">2021-09-10</span></td>
                                            <td><span class="">Cancel</span></td>
                                            <td><span class="">5</span></td>
                                            <td><span class="action-eye"><i class="fa fa-eye"></i></span></td>
                                        </tr>

                                    </table>
                                </div>
                                <!-- </div> -->

                                <div class="d-flex">
                                    <div class="mr-auto showi-of-1"><p>Showing 1 to 1 of 1 entire</p></div>
                                    <div class="">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                            </ul>
                                        </nav>
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