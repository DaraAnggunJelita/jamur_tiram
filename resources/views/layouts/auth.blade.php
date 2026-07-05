<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Authentication') - {{ config('app.name', 'KUPS Harapan Asri') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            h1, h2, h3, h4, .font-heading {
                font-family: 'Outfit', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-[#f8fafc] min-h-screen flex items-center justify-center">

        <div class="w-full max-w-[920px] h-[540px] m-4 rounded-[2rem] bg-white shadow-xl border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-2 animate-fade-in-up">

            @section('sidebar')
            <div class="hidden lg:flex relative bg-slate-900 p-10 flex-col justify-between overflow-hidden">
                <div class="absolute inset-0 z-0 bg-cover bg-center"
                     style="background-image: url('{{ asset('images/oyster_mushroom_hero.png') }}');">
                </div>

                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/70 z-0"></div>

                <div class="relative z-10 flex items-center gap-2.5">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15 backdrop-blur-md border border-white/10">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.728 0A9 9 0 115.636 5.636l12.728 12.728z" />
                        </svg>
                    </div>
                    <span class="text-white font-bold tracking-wider text-xs uppercase">KUPS Harapan Asri</span>
                </div>

                <div class="relative z-10 my-auto">
                    <h2 class="text-white text-3xl font-extrabold tracking-tight leading-[1.2]">
                        @yield('sidebar-title', 'Pantau Pertumbuhan Jamur Secara Digital')
                    </h2>
                    <p class="mt-4 text-slate-200 leading-relaxed text-xs font-medium">
                        @yield('sidebar-description', 'Optimalkan hasil panen dengan pemantauan suhu, kelembaban, dan siklus pertumbuhan secara real-time.')
                    </p>
                </div>

                <div class="relative z-10 text-[10px] text-white/40 tracking-wide">
                    &copy; {{ date('Y') }} KUPS Harapan Asri. All rights reserved.
                </div>
            </div>
            @show

            <div class="p-8 lg:p-10 flex flex-col justify-between bg-white h-full overflow-y-auto">

                <div class="w-full max-w-[320px] mx-auto my-auto">
                    @yield('content')
                </div>

                <div class="flex items-center justify-center gap-4 text-[10px] font-bold tracking-wider text-slate-300 uppercase mt-4">
                    <a href="#" class="hover:text-slate-500 transition-colors">Privacy</a>
                    <span>&middot;</span>
                    <a href="#" class="hover:text-slate-500 transition-colors">Terms</a>
                    <span>&middot;</span>
                    <a href="#" class="hover:text-slate-500 transition-colors">Support</a>
                </div>

            </div>
        </div>

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: scale(0.98) translateY(12px);
                }
                to {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }
        </style>
    </body>
</html>
