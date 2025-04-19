@extends('../Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg" style="background: linear-gradient(rgb(8 8 8 / 56%), rgb(40 40 40 / 51%)), url('{{ url('/') }}/public/images/{{ $about->background ?? 'background.png'}}'); background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Page <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-item">{{ $about->title }}</span>
                    </nav>
                    <h1 class="text-center">{{ $about->title }}</h1>
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