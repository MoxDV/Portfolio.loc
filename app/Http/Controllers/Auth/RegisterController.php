<?php

namespace Portfolio\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Portfolio\ConfirmEmail;
use Portfolio\Mail\EmailVerification;
use Portfolio\Mail\OrderShipped;
use Portfolio\User;
use Portfolio\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        $rules = User::$validates + [
                'name'      => 'honeypot',
                'time'      => 'required|honeytime:5',
            ];
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Portfolio\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Отображает форму регистрации нового пользователя.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm() {
        return view('auth.register')->with([
            'title' => 'Регистрация',
        ]);
    }

    /**
     * Регистрирует нового пользователя.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function register(Request $request){
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($user){
            $ce = ConfirmEmail::create([
                'user_id'   => $user->id,
                'token'     => str_random(32),
            ]);
            Mail::to($user)->queue(new EmailVerification($ce));

            return redirect()->route('login')->withInput()
                ->with('success', 'Для подтверждения email откройте '
                    .'почтовый ящик и перейдите по указанной ссылке в '
                    .'течении суток!');
        }

        return back()->withInput()->withErrors([
            'email' => 'Что то пошло не так! Повторно пройдите регистрацию.'
        ]);
    }

    /**
     * Подтверждает email и активирует пользователя.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token) {
        $ce = ConfirmEmail::with('user')->where('token', $token)->first();
        if(!$ce)
            return redirect()->route('register')
                ->withErrors(['email' => 'Запрос устарел. '
                    .'Пройдите регистрацию заново!']);

        $user = $ce->user;
        $ce->delete();
        $user->update(['status' => 1]);
        return redirect()->route('login')
            ->with('success', 'Регистрация прошла успешно');
    }
}
