<ul class="nav" id="side-menu">
    {{-- Старница с информацией --}}
    <li><a href="{{ route('admin.index') }}">
            <i class="fa fa-dashboard nav_icon"></i>Информация
        </a></li>

    {{-- Старница с информацией --}}
    @role('EDIT_BANNER')
        <li><a href="{{ route('admin.banner') }}">
                <i class="fa fa-diamond nav_icon"></i>Баннер
            </a></li>
    @endrole

    {{-- Выход --}}
    <li><a href="{{ route('logout') }}">
            <i class="fa fa-sign-out nav_icon"></i>Выход
        </a></li>
</ul>