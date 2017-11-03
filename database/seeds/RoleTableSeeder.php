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
