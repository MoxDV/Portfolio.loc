
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
        {!! $banner['bannerText'] !!}
    </p>
    <hr />
    <div class="social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-vk"></i></a>
        <a href="#"><i class="fa fa-odnoklassniki"></i></a>
        <a href="#"><i class="fa fa-skype"></i></a>
    </div>
</div>