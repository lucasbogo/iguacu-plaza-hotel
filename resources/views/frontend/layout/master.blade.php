<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <title>Iguaçu Plaza Hotel</title>

    <link rel="icon" type="image/png" href="{{ asset('uploads/' . $global_setting->favicon) }}">

    <!-- All CSS -->
    @include('frontend.layout.styles')

    <!-- All Javascripts -->
    @include('frontend.layout.scripts')

    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500&display=swap" rel="stylesheet">

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $global_setting->analytic_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ $global_setting->analytic_id }}');
    </script>

    <style>
        .main-nav nav .navbar-nav .nav-item a:hover,
        .main-nav nav .navbar-nav .nav-item:hover a,
        .slide-carousel.owl-carousel .owl-nav .owl-prev:hover,
        .slide-carousel.owl-carousel .owl-nav .owl-next:hover,
        .home-feature .inner .icon i,
        .home-rooms .inner .text .price,
        .home-rooms .inner .text .button a,
        .blog-item .inner .text .button a,
        .room-detail-carousel.owl-carousel .owl-nav .owl-prev:hover,
        .room-detail-carousel.owl-carousel .owl-nav .owl-next:hover {
            color: {{ $global_setting->theme_color_1 }}
        }

        .main-nav nav .navbar-nav .nav-item .dropdown-menu li a:hover,
        .primary-color {
            color: {{ $global_setting->theme_color_1 }} !important;
        }

        .testimonial-carousel .owl-dots .owl-dot,
        .footer ul.social li a,
        .footer input[type="submit"],
        .scroll-top,
        .room-detail .right .widget .book-now {
            background-color: {{ $global_setting->theme_color_1 }};
        }

        .slider .text .button a,
        .search-section button[type="submit"],
        .home-rooms .big-button a,
        .bg-website {
            background-color: {{ $global_setting->theme_color_1 }} !important;
        }

        .slider .text .button a,
        .slide-carousel.owl-carousel .owl-nav .owl-prev:hover,
        .slide-carousel.owl-carousel .owl-nav .owl-next:hover,
        .search-section button[type="submit"],
        .room-detail-carousel.owl-carousel .owl-nav .owl-prev:hover,
        .room-detail-carousel.owl-carousel .owl-nav .owl-next:hover,
        .room-detail .amenity .item {
            border-color: {{ $global_setting->theme_color_1 }} !important;
        }

        .home-feature .inner .icon i,
        .home-rooms .inner .text .button a,
        .blog-item .inner .text .button a,
        .room-detail .amenity .item,
        .cart .table-cart tr th,
        .top {
            background-color: {{ $global_setting->theme_color_2 }} !important;
        }
    </style>

</head>

<body>

    @include('frontend.layout.header')

    @yield('main_content')

    @include('frontend.layout.footer')

    @include('frontend.layout.scripts_footer')

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                iziToast.error({
                    title: 'Erro',
                    message: '{{ $error }}',
                    position: 'topRight'
                });
            @endforeach
        </script>
    @endif

    @if (session()->get('error'))
        <script>
            iziToast.error({
                title: 'Erro',
                message: '{{ session()->get('error') }}',
                position: 'topRight'
            });
        </script>
    @endif

    @if (session()->get('success'))
        <script>
            iziToast.success({
                title: 'Sucesso',
                message: '{{ session()->get('success') }}',
                position: 'topRight'
            });
        </script>
    @endif

</body>

</html>
