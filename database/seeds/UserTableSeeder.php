<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Запускает занесения данных в таблицу пользователей.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name'  => 'Administrator',
            'email'      => 'admin@mail.ru',
            'password'   => bcrypt('aq1AQ!'),
            'status'     => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
