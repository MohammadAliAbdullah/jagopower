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
                        <h1 class="text-center">Hot Offer</h1>
                    </div>
                </div>
                <div class="row">
                    @include('frontend.partials.product_box',['products' => $products])
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        {{ $products->render() }}
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
