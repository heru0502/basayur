<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insertOrIgnore([
            ['id' => 1, 'name' => 'kg'],
            ['id' => 2, 'name' => 'gram'],
            ['id' => 3, 'name' => 'pcs'],
            ['id' => 4, 'name' => 'bungkus'],
            ['id' => 5, 'name' => 'ikat'],
            ['id' => 6, 'name' => 'ons'],
            ['id' => 7, 'name' => 'iris'],
            ['id' => 1, 'name' => 'lonjor']
        ]);
    }
}
