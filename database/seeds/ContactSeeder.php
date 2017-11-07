<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

/**
 * Class ContactSeeder
 *
 * Класс для внесения первоначальных данных в раздел "Контакты".
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class ContactSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('single_datas')->insert([
            'identifier' => 'contacts',
            'data' => '{"address": "Областная обл.<br>г.Город<br>'
                .'+7(123) 456-89-01"}',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
