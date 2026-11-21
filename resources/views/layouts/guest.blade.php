<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="sijadin">
    <meta name="description" content="Sistem informasi layanan sppd">

    <meta name="og:description" content="Sistem informasi layanan sppd">
    <meta name="og:author" content="sijadin">
    <meta name="og:site_name" content="SIJADIN">

    <link rel="canonical" href="https://kedap.pupr-acehbaratkab.com/">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('libs/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
    <title>{{ $attributes->get('title', 'Selamat datang') }} | {{ config('app.name') }}</title>
</head>

<body class="bg-light">
    {{-- Halaman dengan atribut `split` mengatur seluruh tata letaknya sendiri (mis. login dua kolom). --}}
    @if ($attributes->has('split'))
        {{ $slot }}
    @else
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">
                <div class="py-8 col-12 col-md-8 col-lg-6 col-xxl-4 py-xl-0">
                    {{ $slot }}
                </div>
            </div>
        </div>
    @endif

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    @stack('script')
</body>

</html>
