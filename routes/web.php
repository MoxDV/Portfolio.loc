<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index'/*function () {
    return view('site.site');
}*/)->name('home');

Auth::routes();
// Подтверждение email пользователя
Route::get('/verify-email/{token}', 'Auth\RegisterController@verify')
    ->name('verify_email');

Route::group(['middleware' => 'auth'], function (){
    Route::get('/logout', 'HomeController@logout')
        ->name('logout');
});

// -----------   АДМИНИСТРАТИВНАЯ ЧАСТЬ САЙТА   ------------------------------
Route::group([
    'middleware'    => 'auth',
    'prefix'        => 'admin',
    'as'            => 'admin.',
    'namespace'     => 'Admin',
], function (){
    // Отображает домашнюю страницу административного сайта
    Route::get('/', 'IndexController@index')->name('index');

    // Редактирование баннера
    Route::match(['get', 'post'], '/banner', 'BannerController@index')
        ->name('banner');
});

Route::get('/test', function (){
    /*$link = route('password.reset', ['token' => str_random(32)]);
    $user = Portfolio\User::first();
    return view('layouts.mail')
        ->with([
            'name' => $user->first_name,
            'text_first' => view('mails.password_reset_first')->render(),
            'link' => $link,
            'text_button' => 'Сбросить',
            'text_last' => view('mails.password_reset_last')
                ->with('link', $link)->render(),
        ]);*/

    \Portfolio\SingleData::setData('banner', [
        'fullName' => "Имя Фамилия",
        'bannerText' => 'I\'m a Manila based <span>graphic designer</span>, '
            .'<span>illustrator</span> and <span>webdesigner</span> '
            .'creating awesome and effective visual identities for '
            .'companies of all sizes around the globe. Let\'s '
            .'<a class="banner-link link" href="#about">start scrolling</a> '
            .'and learn more <a class="banner-link link" href="#about">about '
            .'me</a>.',
    ]);
    return \Portfolio\SingleData::getData('banner');
});

//Route::get('/home', 'IndexController@index')->name('test');
