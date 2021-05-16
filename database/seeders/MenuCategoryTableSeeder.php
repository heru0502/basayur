<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_categories')->insertOrIgnore([
            ['id' => 1, 'name' => 'sayuran'],
            ['id' => 2, 'name' => 'ikan'],
            ['id' => 3, 'name' => 'daging'],
            ['id' => 4, 'name' => 'bumbu'],
            ['id' => 5, 'name' => 'produk olahan'],
            ['id' => 6, 'name' => 'produk awetan'],
            ['id' => 7, 'name' => 'bahan baku'],
            ['id' => 8, 'name' => 'buah']
        ]);
    }
}
