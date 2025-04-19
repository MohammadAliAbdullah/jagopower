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
                                <li class="breadcrumb-item active" aria-current="page">Wallet</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @include('Mypanel.verification')
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
                                <h5>Wallet Balance</h5>
                            </div>
{{--                            <div class="add-btn-area">--}}
{{--                                <a href="#">Add new shipping address</a>--}}
{{--                            </div>--}}
                            <div class="anather">
                                <div class="row">
{{--                                    <div class="col-md-3">--}}
{{--                                        <div class="anather1">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="#">Deposit</a></li>--}}
{{--                                                <li><a href="#">Point In</a></li>--}}
{{--                                                <li><a href="#">Point Out</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-md-4">
                                        <div class="anather1">
                                            <div class="total-area text-center">
                                                <h5>Current <br>Balance</h5>
                                                <p>
                                                    {{ $wallet->current_balance }} ৳
                                                </p>
{{--                                                <p>30 Agust 2021</p>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="anather1">
                                            <div style="background-color: #FCB800;" class="total-area text-center">
                                                <h5>Cashback <br>Balance</h5>
                                                <p>
                                                    {{ $wallet->cashback_balance }} ৳
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="anather1">
                                            <div style="background-color: #016DA9;" class="total-area text-center">
                                                <h5>GiftCard <br>Balance</h5>
                                                <p>
                                                    {{ $wallet->giftcard_balance }} ৳
                                                </p>
                                            </div>
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