<?php

namespace Database\Seeders;

use App\Models\Coupone;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupone::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => 30,
        ]);

        Coupone::create([
            'code' => 'DEF456',
            'type' => 'percent',
            'percent_off' => 50,
        ]);
    }
}
