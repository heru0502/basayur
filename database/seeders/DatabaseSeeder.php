<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
            UnitTableSeeder::class,
            MenuCategoryTableSeeder::class,
            DeliveryTableSeeder::class,
            PaymentTableSeeder::class,
            StatusDeliveryTableSeeder::class,
            StatusOrderTableSeeder::class,
            StatusPaymentTableSeeder::class
        ]);
    }
}
