<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

/**
 * Class BannerSeeder
 *
 * Класс для внесения первоначальных данных в домашний раздел.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class BannerSeeder extends Seeder {
    public function run() {
        DB::table('single_datas')->insert([
            'identifier' => 'banner',
            'data' => '{"fullName":"Имя Фамилия","bannerText":"I\'m a Manila'
                .'based <span>graphic designer<\/span>, <span>illustrator'
                .'<\/span> and <span>webdesigner<\/span> creating awesome '
                .'and effective visual identities for companies of all sizes '
                .'around the globe. Let\'s <a class=\"banner-link link\" '
                .'href=\"#about\">start scrolling<\/a> and learn more <a '
                .'class=\"banner-link link\" href=\"#about\">about me<\/a>."}'
        ]);
    }
}
