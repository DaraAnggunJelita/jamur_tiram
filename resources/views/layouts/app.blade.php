<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>KUPS Harapan Asri — Monitoring Jamur Tiram</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600;9..144,700;9..144,800;9..144,900&family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Variabel Warna KUPS Harapan Asri */
            :root {
                --paper:       #F6F1E6;
                --paper-2:     #FBF8F1;
                --ink:         #26201B;
                --tan:         #C9B896;
                --moss:        #4F6146;
                --moss-light:  #7C9169;
            }

            body {
                font-family: 'Inter', sans-serif;
            }
            h1, h2, h3, h4, .font-heading {
                font-family: 'Fraunces', serif;
                font-optical-sizing: auto;
            }
            .font-mono-data {
                font-family: 'JetBrains Mono', monospace;
            }

            /* Custom scrollbar bertema alam sirkular */
            ::-webkit-scrollbar { width: 5px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: var(--tan); border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: var(--moss-light); }
        </style>
    </head>
    <body class="font-sans antialiased text-[var(--ink)] bg-[#F6F1E6] selection:bg-[#4F6146] selection:text-white" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen bg-[#F6F1E6]">

            @include('layouts.sidebar')

            <div class="md:pl-64 lg:pl-72 flex flex-col min-h-screen">

                @include('layouts.topbar')

                @isset($header)
                    <header class="bg-[#FBF8F1] border-b border-[#C9B896]/40 shadow-xs">
                        <div class="max-w-full py-5 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1 bg-[#F6F1E6]">
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
