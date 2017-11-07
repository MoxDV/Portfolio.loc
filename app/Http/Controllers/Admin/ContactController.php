<?php

namespace Portfolio\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Portfolio\SingleData;

/**
 * Class ContactController
 * @package Portfolio\Http\Controllers\Admin
 *
 * Класс для редактирования контактов автора.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class ContactController extends AdminController {
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        if (!auth()->user()->hasRole('EDIT_CONTACTS')) abort(403);


        if($request->isMethod('post')){
            $this->validate($request, [
                'address' => 'required|min:10',
            ]);
            $data = $request->except(['_token', ]);
            $data['address'] = str_replace("\r", "", $data['address']);
            $data['address'] = str_replace("\n", '<br />', $data['address']);

            $cont = SingleData::setData('contacts', $data);
            if($cont){
                cache()->forget('contacts');
                return back()->withInput()
                    ->with('success', 'Контакты успешно изменены!');
            }
            
            return back()
                ->withInput()
                ->withErrors(['all' => 'Что то пошло не так! Повторите '
                    .'попытку позже!']);
        }
        $address = SingleData::getData('contacts')['address'];
        $address = str_replace('<br />', "\n", $address);

        $this->title = "Контакты";
        $this->content = view('admin.contacts')->with([
            'address' => $address,
        ])->render();
        return $this->renderPage();
    }
}
