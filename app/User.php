<?php

namespace Portfolio;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'status', ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Определяет параметры валидации данных при создании пользователя.
     *
     * @var array
     */
    public static $validates = [
        'first_name'    => 'required|max:191|min:2',
        'last_name'     => 'required|max:191|min:2',
        'email'         => 'required|email|max:191|unique:users',
        'password'      => 'required|max:191|min:6|confirmed',
    ];

    /**
     * Отправляет email с ссылкой сброса пароля.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token) {
        Mail::to($this->email)->send(new ResetPasswordNotification($this, $token));
    }
}
