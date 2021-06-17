<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_payments')->insertOrIgnore(['id' => 1, 'name' => 'pending']);
        DB::table('status_payments')->insertOrIgnore(['id' => 2, 'name' => 'paid']);
        DB::table('status_payments')->insertOrIgnore(['id' => 3, 'name' => 'failure']);
    }
}
