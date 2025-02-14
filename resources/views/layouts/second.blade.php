<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART AO | Sistem Monitoring Realtime & Terintegrasi AO</title>
  <link rel="icon" type="image/png" href="{{ env('/assets/images/') }} /favicon.png')">
  @vite(['resources/css/main.css', 'resources/css/output.css'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>
<body>
  <main class="bg-[#FAFAFA] max-w-[640px] mx-auto min-h-screen relative flex flex-col has-[#CTA-nav]:pb-[120px] has-[#Bottom-nav]:pb-[120px]">
    <div class="content">
      @yield('content')
    </div>
    @include('partials.footer')
  </main>

  @stack('javascript')
</body>
</html>