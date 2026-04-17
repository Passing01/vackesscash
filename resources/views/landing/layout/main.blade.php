<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vackess Cash</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.svg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/aos-master/dist/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
</head>

<body>
    @include('landing.layout.header')
    @yield('content')
    @include('landing.layout.footer')

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/libs/aos-master/dist/aos.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>