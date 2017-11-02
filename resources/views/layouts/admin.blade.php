<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Админка{{ $title ? ' | '.$title : ''  }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel='stylesheet'
          type='text/css' />
    <!-- Custom CSS -->
    <link href="{{ asset('css/admin-style.css') }}" rel='stylesheet'
          type='text/css' />
    <!-- Graph CSS -->
    <link href="{{ asset('css/lines.css') }}" rel='stylesheet'
          type='text/css' />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!----webfonts--->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'
          rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Nav CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @yield('head')
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="top1 navbar navbar-default navbar-static-top" role="navigation"
         style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('site.name') }}</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                    <img src="{{ auth()->user()->image  }}"></a>
                <ul class="dropdown-menu">
                    <li class="m_2"><a href="{{--{{ route('settings') }}--}}">
                            <i class="fa fa-wrench"></i> Настройки
                        </a></li>
                    <li class="m_2"><a href="{{ route('logout') }}">
                            <i class="fa fa-lock"></i> Выход
                        </a></li>
                </ul>
            </li>
        </ul>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                @yield('navigation')
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="graphs">

            @yield('content')

            <div class="copy">
                <p>Copyright &copy; 2017 {{ config('site.name') }}. Все права защищены | Дизайн
                    <a href="http://w3layouts.com/" target="_blank">W3layouts</a>
                </p>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
</body>
</html>