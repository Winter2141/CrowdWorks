<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'login_id' => 'admin@crowdworks.com',
                'password' =>Hash::make('12345678'),
            ]
        ]);
    }
}
