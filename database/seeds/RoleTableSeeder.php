<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

/**
 * Class RoleTableSeeder
 *
 * Класс для заполнения прав доступа к административной части.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class RoleTableSeeder extends Seeder {
    protected $roles = [
        [
            'name' => 'VIEW_ADMIN',
            'description' => 'Доступ к административной части сайта',
        ],
        [
            'name' => 'EDIT_BANNER',
            'description' => 'Доступ к редактированию баннера',
        ],
        [
            'name' => 'VIEW_SOCIAL',
            'description' => 'Доступ к администрированию социальных сетей',
        ],
        [
            'name' => 'ADD_SOCIAL',
            'description' => 'Доступ к добавлению соц.сети',
        ],
        [
            'name' => 'EDIT_SOCIAL',
            'description' => 'Доступ к редактированию соц.сети',
        ],
        [
            'name' => 'DELETE_SOCIAL',
            'description' => 'Доступ к удалению соц.сети',
        ],
        [
            'name' => 'RESTORE_SOCIAL',
            'description' => 'Доступ у восстановлению удаленных соц.сетей',
        ],
        [
            'name' => 'EDIT_ABOUT',
            'description' => 'Доступ к редактированию информации обо мне',
        ],
        [
            'name' => 'EDIT_CONTACTS',
            'description' => 'Доступ к редактированию контактов автора',
        ],
    ];

    /**
     * Заносит данные в таблицу ролей.
     *
     * @return void
     */
    public function run() {
        foreach ($this->roles as $role){
            $role += [
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ];
            DB::table('roles')->insert($role);
        }
    }
}
