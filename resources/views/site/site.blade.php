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
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/site.css') }}">

        <!-- === Script === -->
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/site.js') }}"></script>

        <!-- === Favicons === -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" >
    </head>
    <body>
        <svg display="none" width="0" height="0" version="1.1"
             xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <symbol id="icon-menu"  viewBox="0 0 20 20">
                    <title>Menu</title>
                    <path d="M16.4,9H3.6C3.048,9,3,9.447,3,10c0,0.553,0.048,1,0.6,1
                    H16.4c0.552,0,0.6-0.447,0.6-1C17,9.447,16.952,9,16.4,9z M16.4,13
                    H3.6C3.048,13,3,13.447,3,14c0,0.553,0.048,1,0.6,1H16.4
                    c0.552,0,0.6-0.447,0.6-1C17,13.447,16.952,13,16.4,13z M3.6,7H16.4
                    C16.952,7,17,6.553,17,6c0-0.553-0.048-1-0.6-1H3.6C3.048,5,3,5.447,3,6
                    C3,6.553,3.048,7,3.6,7z"/>
                </symbol>
                <symbol id="icon-email" viewBox="0 0 612 612">
                    <title>E-mail</title>
                    <path d="M306.768,346.814h0.131c4.615,0,9.176-1.339,
                    12.866-3.777l1.001-0.643c0.218-0.142,0.446-0.271,
                    0.675-0.424l11.658-9.645 l278.259-229.624
                    c-0.576-0.795-1.557-1.339-2.602-1.339
                    H3.233c-0.751,0-1.448,0.272-2.003,0.729l291.125,239.954
                    C296.024,345.083,301.259,346.814,306.768,346.814z M0,
                    133.899v340.37l208.55-168.471L0,133.899z M403.668,
                    306.941L612,474.356   V135.031L403.668,306.941z
                    M337.431,361.585c-8.305,6.814-19.168,10.57-30.576,
                    10.57c-11.451,0-22.304-3.734-30.587-10.516 l-47.765-39.394
                    L0,506.806v0.587c0,1.753,1.502,3.244,3.276,3.244h605.491
                    c1.741,0,3.232-1.491,3.232-3.255v-0.544L383.693,323.4
                    L337.431,361.585z"/>
                </symbol>
            </defs>
        </svg>
        <section id="about" class="section invert">
            @include('site.about')
        </section>
        <header id="header" class="section">
            @include('site.header')
        </header>
        <section id="resume" class="section">
            @include('site.resume')
        </section>
        <section id="works" class="section">
            @include('site.works')
        </section>
        <section id="contact" class="section invert">
            @include('site.contact')
        </section>
    </body>
</html>