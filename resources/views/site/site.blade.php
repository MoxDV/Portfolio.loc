<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- === Базовые настройки === -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ __('site.title') }}</title>
        <meta name="description" content="{{ __('site.description') }}">
        <meta name="author" content="www.moxdv.h1n.ru">

        <!-- === Управление разметкой на мобильных браузерах === -->
        <meta name="viewport"
              content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- === CSS === -->
        <link rel="stylesheet" href="{{ asset('css/site.css') }}">

        <!-- === Script === -->
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/site.js') }}"></script>

        <!-- === Favicons === -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" >
    </head>
    <body>
        <section id="about" class="section">
            <h1>About</h1>
        </section>
        <header id="header" class="section">
            @include('site.header')
        </header>
    </body>
</html>