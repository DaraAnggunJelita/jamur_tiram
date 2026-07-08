<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        </style>
    </head>
    <body class="font-sans text-[#26201B] antialiased bg-[#F6F1E6]">
        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-10 sm:px-6 bg-gradient-to-br from-[#F6F1E6] via-[#FBF8F1] to-[#F6F1E6]">
            <div class="text-center">
                <a href="/" class="inline-flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-tr from-[#37452F] via-[#4F6146] to-[#7C9169] rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-black text-xl font-heading">K</span>
                    </div>
                    <span class="text-xl font-black text-[#26201B] font-heading">{{ config('app.name', 'KUPS Harapan Asri') }}</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-6 py-8 bg-[#FBF8F1] shadow-xl rounded-3xl border border-[#C9B896]/40">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
