<?php

namespace Portfolio\Http\Controllers\Auth;

use Portfolio\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Показывает форму входа в систему.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm() {
        return view('auth.login')->with([
            'title' => 'Вход',
        ]);
    }

    /**
     * Проверяет данные на корректный ввод.
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request) {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password'  => 'required|string',
            'name'      => 'honeypot',
            'time'      => 'required|honeytime:5',
        ]);
    }

    /**
     * Получает необходимые данные для авторизации.
     *
     * @param Request $request
     * @return mixed
     */
    protected function credentials(Request $request) {
        return $request->only($this->username(), 'password')
            + ['status' => 1];
    }
}
