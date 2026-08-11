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
        h1, h2, h3, h4, p {
            font-family: 'Outfit', sans-serif;
        }
        input::-ms-reveal,
        input::-ms-clear {
            display: none !important;
        }
    </style>
</head>
<body class="font-sans text-slate-900 antialiased bg-[#f8fafc] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-[920px] h-[540px] m-4 rounded-[2rem] bg-white shadow-xl border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-2 animate-fade-in-up">

        @section('sidebar')
        <div class="hidden lg:block relative bg-slate-900 overflow-hidden">
            <div class="absolute inset-0 z-0 bg-cover bg-center" 
                 style="background-image: url('{{ asset('images/oyster_mushroom_hero.png') }}');">
            </div>

            <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-black/60 to-transparent z-0"></div>

            <div class="relative z-10 p-8 flex items-center gap-2.5">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/20 backdrop-blur-md border border-white/20 shadow-md">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.728 0A9 9 0 115.636 5.636l12.728 12.728z" />
                    </svg>
                </div>
                <span class="text-white font-extrabold text-sm tracking-wide drop-shadow-sm">KUPS Harapan Asri</span>
            </div>
        </div>
        @show

        <div class="p-8 lg:p-10 flex flex-col justify-start bg-white h-full overflow-y-auto">

            <div class="w-full max-w-[320px] mx-auto pt-2">
                @yield('content')
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
