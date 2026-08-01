<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}" class="scroll-smooth">
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>KUPS Harapan Asri — Monitoring Jamur Tiram</title>

 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600;9..144,700;9..144,800;9..144,900&family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

 @vite(['resources/css/app.css','resources/js/app.js'])

  <style>
    /* Variabel Warna KUPS Harapan Asri */
    :root {
      --paper: #F3F5F4;
      --paper-2: #FFFFFF;
      --ink: #064E3B;
      --tan: #E5E7EB;
      --moss: #059669;
      --moss-light: #34D399;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    /* Custom scrollbar bertema alam sirkular */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #059669; }
  </style>
 </head>
 <body class="font-sans antialiased text-[var(--ink)] bg-[#F3F5F4] selection:bg-[#059669] selection:text-white" x-data="{ sidebarOpen: false }">
 <div class="min-h-screen bg-[#F3F5F4]">

 @include('layouts.sidebar')

 <div class="md:pl-56 lg:pl-60 flex flex-col min-h-screen">

 @include('layouts.topbar')



 <main class="flex-1 bg-[#F3F5F4]">
 @isset($slot)
 {{ $slot }}
 @else
 @yield('content')
 @endisset
 </main>

 </div>
 </div>
 </body>
</html>
