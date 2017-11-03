
<a class="mobile-btn" href="#" title="Меню" id="menu-btn">
    <svg class="icon-menu">
        <use xlink:href="#icon-menu"></use>
    </svg>
​‌</a>

<nav class="" id="menu">
    <a class="item-nav link" href="#header">Домашняя</a>
    <a class="item-nav link" href="#about">Обо мне</a>
    <a class="item-nav link" href="#resume">Резюме</a>
    <a class="item-nav link" href="#works">Работы</a>
    <a class="item-nav link" href="#contact">Контакты</a>
</nav>

<div class="banner">
    <div class="full-name">{{ $banner['fullName'] }}</div>
    <p class="banner-text">
        {!! $banner['data'] !!}
    </p>
    <hr />
    @if($socials->count() > 0)
        <div class="social">
            @foreach($socials as $social)
                <a href="{{ $social->path }}" title="{{ $social->title }}">
                    <i class="fa {{ $social->icon }}"></i>
                </a>
            @endforeach
        </div>
    @endif
</div>