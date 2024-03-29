<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Piqraise - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @yield('addtionalMeta')
    </head>

    <body class="h-full flex flex-col">
        <header>
            @guest
                @include('commons.navbar')
            @endguest
            @auth
                @include('commons.navbar_logined')
            @endauth
        </header>

        <main class="block flex-bottom">
            @yield('content')
        </main>

        <footer>
            @include('commons.footer')
        </footer>
    </body>
</html>
