<?php

namespace Portfolio\Http\Controllers\Admin;

use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package Portfolio\Http\Controllers\Admin
 *
 * Класс для отображения домашней страницы административной части.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class IndexController extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Формирует домашнюю страницу административного раздела сайта.
     *
     * @return View
     */
    public function index(){
        //if(!Auth::user()->hasRole('VIEW_ADMIN')) abort(403);

        //$cc = new CartController();
        //$buys = Buy::where('cart', false)->get();

        $this->content = view('admin.index')
            ->with([
                //'users' => User::count(),
                //'goods' => Goods::count(),
                //'buys'  =>$buys->count(),
                //'sumBuys' => $cc->getSumBuys($buys, false),
            ])
            ->render();

        return $this->renderPage();
    }
}
