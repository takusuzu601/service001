<?php

namespace Database\Seeders;

use App\Models\Cast;
use App\Models\Shop;
use App\Models\ShopDescription;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::factory(250)->create()->each(function(Shop $shop){
            ShopDescription::factory(1)->create([
                'shop_id'=>$shop->id
            ]);
            Cast::factory(12)->create([
                'shop_id'=>$shop->id
            ]);
        });
    }
}
