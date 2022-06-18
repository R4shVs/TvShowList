<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TSL - Tv Show List</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="icon" href="/image/logo.svg" type="image/svg+xml">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-800 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-200  underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-200 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-200 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="text-white space-y-5">
                <div class="flex items-end gap-5 ">
                    <img src="/image/logo.svg" alt="" class="w-12">
                    <h1 class="text-3xl inline-block align-baseline">Tv Show List</h1>
                </div>
                <p class="text-xl">
                    Manage the series you want to watch,
                    <a class="text-blue-200 bg-blue-800 py-2 px-4 rounded ml-2"
                        href="https://github.com/R4shVs/watchlist">get it now!</a>
                </p>
            </div>
        </div>
    </body>
</html>
