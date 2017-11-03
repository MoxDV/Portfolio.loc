<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class SocNetSeeder extends Seeder {
    protected $socNets = [
        [
            'title' => 'Одноклассики',
            'icon' => 'fa-odnoklassniki',
            'path' => 'https://ok.ru/',
        ],
        [
            'title' => 'ВКонтакте',
            'icon' => 'fa-vk',
            'path' => 'https://vk.com/',
        ],
        [
            'title' => 'facebook',
            'icon' => 'fa-facebook',
            'path' => 'https://www.facebook.com/',
        ],
        [
            'title' => 'Skype',
            'icon' => 'fa-skype',
            'path' => 'skype:login?call',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ($this->socNets as $socNet){
            $socNet += [
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
            DB::table('social_networks')->insert($socNet);
        }
    }
}
