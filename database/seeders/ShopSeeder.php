<?php

namespace Database\Seeders;

use App\Models\Cast;
use App\Models\CastImg;
use App\Models\Price;
use App\Models\Shop;
use App\Models\ShopDescription;
use App\Models\ShopImg;
use App\Models\ShopTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
            ])->each(function(Cast $cast){
                CastImg::factory(3)->create([
                    'cast_id'=>$cast->id
                ]);
            });

            Price::factory(3)->create([
                'shop_id'=>$shop->id
            ]);

            ShopImg::factory(3)->create([
                'shop_id'=>$shop->id
            ]);
        });

    }
}
