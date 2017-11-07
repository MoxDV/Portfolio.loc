<div class="photo">
    <img class="about-img" src="{{ asset('images/'.$about['img']) }}">
</div>
<div class="info">
    <div class="about">
        <h1>Обо мне</h1>
        <p>{{ $about['data'] }}</p>
    </div>
    <div class="contact">
        <h1>Контакты</h1>
        <p>
            {{ $banner['fullName'] }}<br>
            {!! $contacts !!}<br>
            {{ env('EMAIL_MODER') }}
        </p>
    </div>
    <div class="download">
        <a href="{{ asset($about['resume']) }}" download>Скачать резюме</a>
    </div>
</div>
