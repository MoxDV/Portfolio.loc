<?php

namespace Portfolio;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Portfolio\Mail\ResetPasswordNotification;

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
        Mail::to($this->email)->queue(new ResetPasswordNotification($this, $token));
    }

    /**
     * Возвращает список ролей пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany('Portfolio\Role', 'role_user')
            ->withTimestamps();
    }

    /**
     * Определяет доступ пользователя выбранным правам.
     *
     * @param $name Задает массив|строку с названием ролей.
     * @param bool $require Задает признак: true - пользователь должен
     * соответствовать каждой роли, false - хотя бы одной роли.
     * @return bool Возвращает истину если пользователь имеет права доступа и
     * ложь если не имеет прав доступа.
     */
    public function hasRole($name, $require = false){
        if(is_array($name)){
            foreach($name as $roleName){
                $hasName = $this->hasRole($roleName);
                if($hasName && !$require){
                    return true;
                } else if(!$hasName && $require){
                    return false;
                }
            }
            return $require;
        } else {
            foreach($this->roles as $role){
                if($role->name == $name){
                    return true;
                }
            }
        }
    }

    /**
     *  Возвращает путь к аватарке пользователя на сайте gravatar.
     *
     * @param $value
     * @return string
     */
    public function getImageAttribute($value){
        return 'https://gravatar.com/avatar/'.md5($this->email).'?d=mm&s=100';
    }
}
