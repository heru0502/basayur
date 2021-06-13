<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'heru0502@gmail.com',
                'password' => bcrypt('rahasia'),
                'role_id' => 1
            ]
        ]);
    }
}
