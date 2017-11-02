<ul class="nav" id="side-menu">
    {{-- Старница с информацией --}}
    <li><a href="{{ route('admin.index') }}">
            <i class="fa fa-dashboard nav_icon"></i>Информация
        </a></li>

    {{-- Выход --}}
    <li><a href="{{ route('logout') }}">
            <i class="fa fa-sign-out nav_icon"></i>Выход
        </a></li>
</ul>