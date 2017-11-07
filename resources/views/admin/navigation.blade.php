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

    {{-- Соц.сети --}}
    @role('VIEW_SOCIAL')
        <li>
            <a href="#">
                <i class="fa fa-users nav_icon" aria-hidden="true"></i>Соц.сети<span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
                {{-- Добавить --}}
                @if(auth()->user()->hasRole('ADD_SOCIAL'))
                    <li><a href="{{route('admin.soc-networks.create')}}">
                            <i class="fa fa-plus nav_icon"></i>Добавить
                        </a></li>
                @endif
                {{-- Редактировать --}}
                @if(auth()->user()->hasRole('EDIT_SOCIAL'))
                    <li><a href="{{route('admin.soc-networks.show', 'edit')}}">
                            <i class="fa fa-pencil nav_icon"></i>Редактировать
                        </a></li>
                @endif
                {{-- Удалить --}}
                @if(auth()->user()->hasRole('DELETE_SOCIAL'))
                    <li><a href="{{route('admin.soc-networks.show', 'delete')}}">
                            <i class="fa fa-times nav_icon"></i>Удалить
                        </a></li>
                @endif
                {{-- Восстановить --}}
                @if(auth()->user()->hasRole('RESTORE_SOCIAL'))
                    <li><a href="{{route('admin.soc-networks.show', 'restore')}}">
                            <i class="fa fa-arrow-up nav_icon"></i>Восстановить
                        </a></li>
                @endif
            </ul>
        </li>
    @endrole

    @role('EDIT_ABOUT')
    <li><a href="{{ route('admin.about') }}">
            <i class="fa fa-user nav_icon"></i>Обо мне
        </a></li>
    @endrole

    @role('EDIT_CONTACTS')
    <li><a href="{{ route('admin.contacts') }}">
            <i class="fa fa-address-card nav_icon"></i>Контакты
        </a></li>
    @endrole

    {{-- Выход --}}
    <li><a href="{{ route('logout') }}">
            <i class="fa fa-sign-out nav_icon"></i>Выход
        </a></li>
</ul>