<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_orders')->insertOrIgnore(['id' => 1, 'name' => 'active']);
        DB::table('status_orders')->insertOrIgnore(['id' => 2, 'name' => 'on progress']);
        DB::table('status_orders')->insertOrIgnore(['id' => 3, 'name' => 'failed']);
        DB::table('status_orders')->insertOrIgnore(['id' => 4, 'name' => 'done']);
    }
}
