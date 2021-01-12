<?php

use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('user_data')->truncate();

        DB::table('users')->insert([
            [
                'name_kanji' => '横井 章夫',
                'name_kana' => 'ヨコイ　アキオ',
                'email' => 'test@user.com',
                'password' =>Hash::make('12345678'),
            ]
        ]);

    }
}
