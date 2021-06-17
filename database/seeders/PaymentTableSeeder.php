<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insertOrIgnore([
            'id' => '1',
            'name' => 'cash',
            'is_active' => 1
        ]);

        DB::table('payments')->insertOrIgnore([
            'id' => '2',
            'name' => 'ovo',
            'is_active' => 0
        ]);

        DB::table('payments')->insertOrIgnore([
            'id' => '3',
            'name' => 'gopay',
            'is_active' => 0
        ]);
    }
}
