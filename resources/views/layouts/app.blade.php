<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>KUPS Harapan Asri — Monitoring Jamur Tiram</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            h1, h2, h3, h4, .font-heading {
                font-family: 'Outfit', sans-serif;
            }
            /* Custom scrollbar untuk sidebar */
            ::-webkit-scrollbar { width: 4px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: rgba(16, 185, 129, 0.25); border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: rgba(16, 185, 129, 0.5); }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-800 bg-slate-50 selection:bg-emerald-500 selection:text-white" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen bg-slate-50">

            <!-- Sidebar Navigation (Fixed, only visible md+) -->
            @include('layouts.sidebar')

            <!-- Main Content Area (offset by sidebar width on md+) -->
            <div class="md:pl-64 lg:pl-72 flex flex-col min-h-screen">

                <!-- Topbar (sticky) -->
                @include('layouts.topbar')

                <!-- Optional Page Heading Slot -->
                @isset($header)
                    <header class="bg-white border-b border-slate-200 shadow-sm">
                        <div class="max-w-full py-5 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Main Page Content -->
                <main class="flex-1 bg-slate-50">
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
