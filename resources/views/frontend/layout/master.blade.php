<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <title>Iguaçu Plaza Hotel</title>

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.ico') }}">

    <!-- All CSS -->
    @include('frontend.layout.styles')

    <!-- All Javascripts -->
    @include('frontend.layout.scripts')

    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500&display=swap" rel="stylesheet">

    <!-- Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-84213520-6"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-84213520-6');
        </script> -->

</head>

<body>

    @include('frontend.layout.header')

    @yield('main_content')

    @include('frontend.layout.footer')

    @include('frontend.layout.scripts_footer')

</body>

</html>
