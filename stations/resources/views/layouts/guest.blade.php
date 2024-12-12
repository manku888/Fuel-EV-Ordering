<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>
        .overlay {
            background-image: url("/images/L1.jpg");
            /* position: absolute; */
            /* top: 0;
            left: 0; */

            width: 100%;
            height: 100%;
            display: flex;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;

            flex-direction: column;
            justify-content: center;
            align-items: center;


        }

    </style>
    <body class="font-sans text-gray-900 antialiased">
        <div class="overlay">
            <!-- <img src="/image/fuel.webp" > -->
        <div  class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <!-- logo -->
           <div >
                <a href="/">
                    <img src="\images\f1logo.png" class="w-20 h-30 "   />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/30 backdrop-invert   backdrop-opacity-5 shadow-md overflow-hidden  sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        </div>
    </body>
</html>
