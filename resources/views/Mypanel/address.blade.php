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
                                <h5>Account Information</h5>
                            </div>
                            <div class="add-btn-area">
                                <a href="#">Add new shipping address</a>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="anather3">

                                        <div class="location-style-div">
                                            <ul>
                                                <li><a href="#">
                                                        <div class="loc-info">
                                                            <icon><i class="fa fa-user"></i></icon>
                                                            <div class="loc-text">
                                                                <p>Omur faruq</p>
                                                            </div>
                                                        </div>
                                                    </a></li>

                                                <li><a href="#">
                                                        <div class="loc-info">
                                                            <icon><i class="fa fa-envelope"></i></icon>
                                                            <div class="loc-text">
                                                                <p>sakil77@gmail.com</p>
                                                            </div>
                                                        </div>
                                                    </a></li>

                                                <li><a href="#">
                                                        <div class="loc-info">
                                                            <icon><i class="fa fa-phone"></i></icon>
                                                            <div class="loc-text">
                                                                <p>+08756788653</p>
                                                            </div>
                                                        </div>
                                                    </a></li>

                                            </ul>

                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                            <label style="font-size: 15px; padding-left: 12px;" for="vehicle1"> Set As Default</label>
                                        </div>

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