<?php

namespace Portfolio;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package Portfolio
 *
 * Модель определяющая роли пользователей.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.1
 */
class Role extends Model {
    protected $table = 'roles';
    protected $fillable =['name', 'description'];

    /**
     * Определяет связь «многие ко многим» с пользователями.
     */
    public function users(){
        return $this->belongsToMany('Portfolio\User', 'role_user')->withTimestamps();
    }
}
