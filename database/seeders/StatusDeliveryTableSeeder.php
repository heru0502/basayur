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

        DB::table('status_orders')->insertOrIgnore(['id' => 1, 'name' => 'on the way']);
        DB::table('status_orders')->insertOrIgnore(['id' => 2, 'name' => 'delivered']);
        DB::table('status_orders')->insertOrIgnore(['id' => 3, 'name' => 'failure']);
    }
}
