<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('public/asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/css/responsive.css') }}">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
<!-- header-top-area -->
@include('layouts.header')

<!-- header-top-area -->


<!-- content-section -->
@yield('content')
<!-- content-section -->

<!-- footer-area -->
@include('layouts.footer')
<!-- footer-area -->

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1619859908827032');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1619859908827032&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<script src="{{ asset('public/asset/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/asset/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/asset/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('public/asset/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('public/asset/js/waypoints.min.js') }}"></script>
<script src="{{ asset('public/asset/js/main.js') }}"></script>

<script>
    $('.counter').counterUp({
        delay: 10,
        time: 1000,
    });
</script>

</body>
</html>
