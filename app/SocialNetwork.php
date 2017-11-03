<?php

namespace Portfolio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SocialNetwork
 * @package Portfolio
 *
 * Модель определяющая соц.сети.
 */
class SocialNetwork extends Model {
    use SoftDeletes;

    protected $table = 'social_networks';
    protected $fillable = ['title', 'icon', 'path'];
    protected $dates = ['deleted_at'];

    public static $validate = [
        'title' => 'required|max:191|min:2',
        'path'  => 'required|max:191|min:5',
        'icon'=> 'required|max:191|min:5',
    ];
}
