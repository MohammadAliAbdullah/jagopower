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
                        <span class="breadcrumb-title">FAQ</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Faq Start -->
    <section class="faqarea">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="colapse-head-area2">
                        <div id="accordion">
                        @php
                        $i=1;
                        @endphp
                        @foreach($values as $value)
                            <div class="card custom-card">
                                <div class="card-header header-card-area" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link head-btn" data-toggle="collapse" data-target="#collapseOne" @if($i==1) aria-expanded="true" @else aria-expanded="false" @endif  aria-controls="collapseOne">
                                            {{ $value->title }}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse @if($i==1) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body custom-card-body">
                                        <p>
                                            {!! $value->content !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ End -->
@endsection
@section('style')
    <link href="{{ asset('public/asset') }}/css/faq.css" rel="stylesheet">
@endsection