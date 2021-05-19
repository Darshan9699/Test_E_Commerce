<?php

namespace Database\Seeders;

use App\Models\Admin;
use Database\Factories\AdminFactory;
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
        //factory to
            Admin::factory()->create();
            $this->call(CategoriesTableSeeder::class);
            $this->call(ProductTableSeeder::class);
            $this->call(CouponsTableSeeder::class);
    }
}
