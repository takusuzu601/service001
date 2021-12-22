<?php

namespace Database\Seeders;

use App\Models\CastType;
use Illuminate\Database\Seeder;

class CastTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CastType::factory(9000)->create();
    }
}
