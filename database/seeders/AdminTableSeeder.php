<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'id' => 1,
                'name' => '管理者',
                'login_id' => 'admin@beaumaxclub.com',
                'password' =>Hash::make('12345678'),
            ]
        ]);
    }
}
