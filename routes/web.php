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

Route::get('/', function () {
    return view('site.site');
})->name('home');

Auth::routes();
// Подтверждение email пользователя
Route::get('/verify-email/{token}', 'Auth\RegisterController@verify')
    ->name('verify_email');

Route::get('/test', function (){
    $link = route('home');
    return view('layouts.mail')->with([
        'name' => 'Митек',
        'text_first' => view('mails.verify_email_first')->render(),
        'link' => $link,
        'text_button' => 'Активировать',
        'text_last' => view('mails.verify_email_last')
            ->with('link', $link)->render(),

    ]);
});

Route::get('/home', 'HomeController@index');
