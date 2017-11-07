<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(SocNetSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(ContactSeeder::class);
    }
}
