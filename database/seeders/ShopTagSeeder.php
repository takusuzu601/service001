<?php

namespace Database\Seeders;

use App\Models\ShopTag;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ShopTagSeeder extends Seeder
{


    public function run()
    {
        ShopTag::factory(250)->create();
    }
}
