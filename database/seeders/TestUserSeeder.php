<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
