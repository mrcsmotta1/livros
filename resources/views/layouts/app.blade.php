<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/images/book.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-alerts.css') }}">

</head>
<body class="bg-light text-dark d-flex flex-column min-vh-100">
    <!-- Navbar -->
    @include('layouts.navigation')

    <!-- Page Header -->
    @isset($header)
        <header class="mb-4">
            <div class="container px-0 py-4 text-white rounded bg-secondary" style="max-width: 1350px;">
                <div class="px-3">
                    {{ $header }}
                </div>
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="container px-0 py-4 flex-grow-1" style="max-width: 1350px;">
       <div class="px-0">
           {{ $slot }}
       </div>
    </main>

    <!-- Bootstrap JS via Mix -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/custom-alerts.js') }}"></script>
    {!! $scripts ?? '' !!}
</body>
</html>
