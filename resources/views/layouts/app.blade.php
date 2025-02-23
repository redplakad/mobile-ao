<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SMART AO') }} | Sistem Monitoring Realtime & Terintegrasi AO</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Stylesheets -->
    @vite(['resources/css/main.css', 'resources/css/output.css'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#FAFAFA] max-w-[640px] mx-auto min-h-screen relative flex flex-col has-[#CTA-nav]:pb-[120px] has-[#Bottom-nav]:pb-[120px]">
    <div class="min-h-screen">
        @include('partials.header')

        <!-- Page Content -->
        <main class="content">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
</body>
</html>