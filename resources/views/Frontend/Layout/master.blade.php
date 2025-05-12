<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    {{-- <title>Femina Lightings Ltd | @yield('meta_title') </title> --}}
    <title>Femina Lightings Ltd </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_keywords')" />
    <meta name="keyword" content="@yield('meta_description')" />
    @if ($seo->google_webmaster != null)
        <meta name="google-site-verification" content="{{ $seo->bing_webmaster }}" />
    @endif
    @if ($seo->bing_webmaster != null)
        <meta name="msvalidate.01" content="{{ $seo->google_webmaster }}" />
    @endif
    @if ($seo->yindex_webmaster != null)
        <meta name="yandex-verification" content="{{ $seo->yindex_webmaster }}" />
    @endif
    <!-- Favicon -->
    <link href="{{ asset('public') }}/images/{{ contacth()->favicon ?? 'notfind.png' }}" rel="icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public') }}/asset/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('public') }}/asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public') }}/asset/css/bootstrap1.css" rel="stylesheet">
    <link href="{{ asset('public') }}/asset/css/style.css" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('public') }}/asset/css/responsive.css" rel="stylesheet">
    <style>
        #scrollTop {
            display: none;
            position: fixed;
            bottom: 40px;
            right: 40px;
            z-index: 99;
        }
    </style>
</head>

<body>
    @include('Frontend.Layout.header')
    @yield('content')
    @include('Frontend.Layout.footer')
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary" id="scrollTop"><i class="fa fa-angle-double-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"
        integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('public') }}/asset/lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('public') }}/asset/js/main.js"></script>
    @yield('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.menu-btn').click(function(event) {
                $('.navbar-demo').toggleClass('open-nav');
            });
        });

        $(document).ready(function() {
            $('.navbar-light .dmenu').hover(function() {
                $(this).find('.sm-menu').first().stop(true, true).slideDown(1);
            }, function() {
                $(this).find('.sm-menu').first().stop(true, true).slideUp(1)
            });
        });

        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1619859908827032');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1619859908827032&ev=PageView&noscript=1" /></noscript>
</body>

</html>

<script>
    $(document).ready(function() {
        $(document).on('click', '.viewProductDetails', function() {
            const url = $(this).data('url');
            // Optional: Show loading indicator
            $('#modalContent').html('<p class="text-center">Loading...</p>');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('#modalContent').html(data);
                    $('#productModal').modal('show');
                    // 
                    setTimeout(function() {
                        $('.xzoom, .xzoom-gallery').xzoom();
                    }, 500);
                },
                error: function() {
                    $('#modalContent').html(
                        '<p class="text-danger">Failed to load product details.</p>');
                }
            });
        });
        $('#productModal').on('hidden.bs.modal', function() {
            // Properly destroy xZoom instance
            let $zoomImage = $('#xzoom-default');
            if ($zoomImage.data('xzoom')) {
                $zoomImage.data('xzoom').destroy();
            }

            // Remove remaining preview DOM elements
            $('.xzoom-preview, .xzoom-lens, .xzoom-loading').remove();
        });


        // Scroll to top on click
        $('#scrollTop').click(function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });

        // Show/hide button on scroll
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('#scrollTop').fadeIn();
            } else {
                $('#scrollTop').fadeOut();
            }
        });
    });
</script>
