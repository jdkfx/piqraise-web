<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GTP - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body class="h-full flex flex-col">
        <header>
            @include('commons.navbar')
        </header>

        <main class="block flex-bottom">
            @yield('content')
        </main>

        <footer>
            @include('commons.footer')
        </footer>
    </body>
</html>
