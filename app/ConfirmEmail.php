<?php

namespace Portfolio;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfirmEmail
 * @package Portfolio
 *
 * Модель содержит ссылку на подтверждение email пользователя.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class ConfirmEmail extends Model {
    protected $table = 'confirm_emails';
    protected $fillable = ['user_id', 'token'];

    public function user(){
        return $this->hasOne('Portfolio\User', 'id', 'user_id');
    }
}
