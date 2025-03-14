<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMART AO | Sistem Monitoring Realtime & Terintegrasi AO</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Stylesheets -->
    @vite(['resources/css/app.css', 'resources/css/main.css'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FAFAFA] min-h-screen flex flex-col items-center">
    <main class="max-w-[640px] w-full flex flex-col relative has-[#CTA-nav]:pb-[120px] has-[#Bottom-nav]:pb-[120px]">
        @yield('content')
    </main>
    <!-- JavaScript -->
    @stack('javascript')
</body>
</html>
