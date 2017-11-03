<?php

namespace Portfolio\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Portfolio\SocialNetwork;

/**
 * Class SocialNetController
 * @package Portfolio\Http\Controllers\Admin
 *
 * Класс для добавления, редактирования и удаления ссылок на соц.сети.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class SocialNetController extends AdminController {
    /**
     * SocNetworksController constructor.
     *
     * Конструктор класса.
     */
    public function __construct(){
        parent::__construct();
        $this->middleware(function ($request, $next){
            if(!auth()->user()->hasRole('VIEW_SOCIAL'))
                abort(403);

            return $next($request);
        });
    }

    /**
     * Возвращает коллекцию удаленных соц.сетей.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getDelSocials(){
        if(!auth()->user()->hasRole('RESTORE_SOCIAL'))
            return collect([]);

        return SocialNetwork::onlyTrashed()->get();
    }


    /**
     * Формирует страницу добавления новой социальной сети.
     *
     * @return View
     */
    public function create() {
        if (!auth()->user()->hasRole('ADD_SOCIAL')) abort(403);

        $this->title = 'Добавление соц.сети';

        $this->content = view('admin.socialsNet.edit')
            ->with([
                'route'         => 'admin.soc-networks.store',
                'method'        => 'POST',
                'title'         => 'Добавление социальной сети',
                'button_txt'    => 'Добавить'
            ])->render();

        return $this->renderPage();
    }

    /**
     * Добавляет социальную сеть.
     *
     * @param  Request  $request Задает запрос пользователя.
     * @return View
     */
    public function store(Request $request) {
        if (!auth()->user()->hasRole('ADD_SOCIAL')) abort(403);

        $this->validate($request, SocialNetwork::$validate);

        $data = $request->except('_token');

        $sn = SocialNetwork::create($data);

        if($sn){
            cache()->forget('socials');
            return back()->with('success', 'Соц.сеть успешно добавлена!');
        }


        return back()->withInput()->withErrors(
            ['all' => ['Что то пошло не так. Повторите позже!']]);
    }

    /**
     * Формирует страницу редактирования социальной сети.
     *
     * @param  int  $id Задает ID соц.сети.
     * @return View
     */
    public function edit($id) {
        if (!auth()->user()->hasRole('EDIT_SOCIAL')) abort(403);

        $this->title = 'Редактирование соц.сети';

        $this->content = view('admin.socialsNet.edit')
            ->with([
                'route'         => ['admin.soc-networks.update', $id],
                'method'        => 'PUT',
                'title'         => 'Редактирование социальной сети',
                'button_txt'    => 'Изменить',
                'social'        => SocialNetwork::findOrFail($id),
            ])->render();

        return $this->renderPage();
    }

    /**
     * Изменяет социальную сеть.
     *
     * @param  Request  $request Задает запрос пользователя.
     * @param  int  $id Задает ID соц.сети.
     * @return View
     */
    public function update(Request $request, $id) {
        $this->validate($request, array_except(SocialNetwork::$validate, ['image',]));

        $data = $request->except('_token');
        $social = SocialNetwork::findOrFail($id);

        if($social->update($data)){
            cache()->forget('socials');
            return redirect()
                ->route('admin.soc-networks.show', 'edit')
                ->with('success', 'Соц.сеть успешно изменена!');
        }

        return back()->withInput()->withErrors(
            ['all' => ['Что то пошло не так. Повторите позже!']]);
    }

    /**
     * Удаляет социальную сеть.
     *
     * @param  int  $id Задает ID соц.сети.
     * @return View
     */
    public function destroy($id) {
        if (!auth()->user()->hasRole('DELETE_SOCIAL')) abort(403);

        $social = SocialNetwork::findOrFail($id);

        if($social->delete()){
            cache()->forget('socials');
            return redirect()
                ->route('admin.soc-networks.show', 'delete')
                ->with('success', 'Соц.сеть успешно удалена!');
        }

        return back()->withInput()->withErrors(
            ['all' => ['Что то пошло не так. Повторите позже!']]);
    }

    /**
     * Восстанавливает ранее удаленную соц.сеть.
     *
     * @param $id Задает идентификатор удаленной категории.
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function restore($id){
        if (!auth()->user()->hasRole('RESTORE_SOCIAL')) abort(403);

        $social = SocialNetwork::onlyTrashed()->where('id', $id)->first();

        if(!$social)
            return back()->withErrors(
                ['all' => ['Что то пошло не так. Повторите позже!']]);

        if($social->restore()){
            cache()->forget('socials');
            return  back()->with('success', 'Соц.сеть успешно восстановлена!');
        }

        return back()->withInput()->withErrors(
            ['all' => ['Что то пошло не так. Повторите позже!']]);
    }

    /**
     * Выводит список соц.сетей для дальнейшей работы с ним.
     *
     * @param $method
     * @return View
     */
    public function show($method){
        $method = strtolower($method);
        switch ($method){
            case 'edit':
                if(!auth()->user()->hasRole('EDIT_SOCIAL')) abort(403);
                $socials = SocialNetwork::all();
                $this->title = $title = 'Редактировать социальные сети';
                break;
            case 'delete':
                if(!auth()->user()->hasRole('DELETE_SOCIAL')) abort(403);
                $socials = SocialNetwork::all();
                $this->title = $title = 'Удалить социальные сети';
                break;
            case 'restore':
                if(!auth()->user()->hasRole('RESTORE_SOCIAL')) abort(403);
                $socials = $this->getDelSocials();
                $this->title = $title = 'Восстановить социальные сети';
                break;
            default: abort(404);
        }

        $this->content = view('admin.socialsNet.show')
            ->with([
                'socials' => $socials,
                'method' => $method,
                'title' => $title,
            ])->render();
        return $this->renderPage();
    }
}
