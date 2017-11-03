<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class RoleUserTableSeeder
 *
 * Класс для заполнения правами первого созданного пользователя правами
 * администратора.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class RoleUserTableSeeder extends Seeder {
    public function run() {
        $user = DB::table('users')->first();
        $roles = DB::table('roles')->get();
        foreach ($roles as $role){
            DB::table('role_user')->insert([
                'user_id'       => $user->id,
                'role_id'       => $role->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
