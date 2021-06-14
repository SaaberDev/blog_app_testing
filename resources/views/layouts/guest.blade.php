<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.gstatic.com"> 

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500&family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        @livewireStyles

        <x-feed-links />
    </head>
    <body class="max-w-4xl mx-auto px-6 pt-24 pb-16 font-sans text-ink bg-paper">
        
        {{ $slot }}

         <footer class="mt-48 text-sm text-center">
            <div class="mx-2 my-4 font-display text-xl">. . .</div>
            <p>
                My Blog is a demo application from the <a class="font-medium hover:underline" href="https://testing-laravel.com">Testing Laravel</a> course by <a class="font-medium hover:underline" href="https://spatie.be">Spatie</a>
            </p>
        </footer>

        @livewireScripts
    </body>
</html>
