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
                        <span class="breadcrumb-title">{{ $about->title }}</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="main-section-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-white p-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about">
                                    @if($about->images!=NULL)
                                        <img src="{{ asset('public/images/page') }}/{{ $about->images }}" alt="" class="img-fluid">
                                    @endif
                                    <p>
                                        {!! $about->content ?? 'N/A' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    </section>
    <!-- main-section-area-start -->
@endsection