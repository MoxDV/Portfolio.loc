<?php

namespace Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Portfolio\SingleData;
use Portfolio\SocialNetwork;

/**
 * Class HomeController
 * @package Portfolio\Http\Controllers
 *
 * Класс для отображения страницы сайта.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class HomeController extends Controller {


    /**
     * Отображает страницу сайта.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('site.site')->with([
            'banner' => $this->getBanner(),
            'socials' => $this->getSocials(),
        ]);
    }

    protected function getBanner(){
        return cache()->remember('banner', 60, function (){
            return SingleData::getData('banner');
        });
    }

    protected function getSocials(){
        return cache()->remember('socials', 60, function (){
            return SocialNetwork::get();
        });
    }

    /**
     * Выход из учетной записи.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        if(auth()->check()) auth()->logout();
        return redirect()->route('home');
    }
}
