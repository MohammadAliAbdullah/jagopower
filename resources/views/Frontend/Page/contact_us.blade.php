@extends('../Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
     <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Page <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Contact Us</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <section class="contact-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="box-item-wraper">
                        <div class="contact-address">
                            <h3>Coporate Office</h3>
                            <p><b>Phone: </b> {{ $office->phone }}</p>
                            <p><b>Email: </b> {{ $office->email ?? '' }}</p>
                            <p><b>Address: </b> {{ $office->address ?? '' }}</p>
                        </div>
                        <div class="contact-map">
                            {!! $office->googlemap !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="box-item-wraper">
                        <div class="contact-address">
                            <h3>Our Shop</h3>
                            <p><b>Phone: </b> {{ $shop->phone }}</p>
                            <p><b>Email: </b> {{ $shop->email ?? '' }}</p>
                            <p><b>Address: </b> {{ $shop->address ?? '' }}</p>
                        </div>
                        <div class="contact-map">
                            {!! $shop->googlemap !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('style')
    <style type="text/css">
        .contact-sec {
            padding: 50px 0;
            background: #e1e1e1;
        }

        .box-item-wraper {
            background: #fff;
            padding: 20px;
        }

        .contact-address h3 {
            font-size: 20px;
            border-bottom: 1px solid #ccc;
            line-height: 35px;
        }

        .contact-address p {
            line-height: 6px;
            font-size: 13px;
        }
    </style>
@endsection
