@extends('Frontend.Layout.master')

@section('content')
    <section>

        <div class="main-section-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">shop</li>
                            </ol>
                        </nav>
                        <h1 class="text-center">Campaign</h1>
                    </div>
                </div>
                <div class="row">
                    @foreach($campaigns as $campaign)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="campaign-area">
                            <a href="{{ route('campaign.slug', $campaign->slug) }}">
                                <img src="{{ asset('public/images/campaign') }}/{{  $campaign->banner }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        {{ $campaigns->render() }}
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>

@endsection

@section('script')
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        };

    </script>
@endsection
