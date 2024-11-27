<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-clip">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-main overflow-x-clip">

        <div class="mx-auto max-w-screen-3xl">
            {{ $slot }}
        </div>

        <footer class="h-8 mt-5 md:mt-10 bg-red-primary"></footer>
    </body>
</html>
