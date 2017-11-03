<?php

namespace Portfolio\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Portfolio\Http\Controllers\Controller;
use Portfolio\SingleData;

/**
 * Class BannerController
 * @package Portfolio\Http\Controllers\Admin
 *
 * Класс для редактирования данных баннера домашней секции.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class BannerController extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request){
        if(!auth()->user()->hasRole('EDIT_BANNER')) abort(403);

        if($request->isMethod('post')){
            $this->validate($request, [
                'fullName' => 'required|max:191|min:5',
                'data' => 'required|min:5',
            ]);
            $data = $request->except(['_token', ]);
            $sd = SingleData::setData('banner', $data);

            if($sd){
                cache()->forget('banner');
                return back()->withInput()
                    ->with('success', 'Баннер успешно изменен!');
            }

            return back()
                ->withInput()
                ->withErrors(['all' => 'Что то пошло не так! Повторите '
                    .'попытку позже!']);
        }

        $this->title = 'Баннер';
        $banner = SingleData::getData('banner');
        $this->content = view('admin.banner')->with([
            'fullName' => $banner['fullName'],
            'data' => $banner['data'],
        ])->render();
        return $this->renderPage();
    }
}
