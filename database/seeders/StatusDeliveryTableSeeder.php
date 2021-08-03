<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusDeliveryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_deliveries')->insertOrIgnore(['id' => 1, 'name' => 'not started']);
        DB::table('status_deliveries')->insertOrIgnore(['id' => 2, 'name' => 'on the way']);
        DB::table('status_deliveries')->insertOrIgnore(['id' => 3, 'name' => 'failed']);
        DB::table('status_deliveries')->insertOrIgnore(['id' => 4, 'name' => 'delivered']);
    }
}
