<?php

namespace Database\Seeders;

use App\Models\ShopTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
           'tagA', 'tagB','tagC','tagD','tagE','tagF','tagG','tagH','tagI'
        ];

        foreach($tags as $tag){
            Tag::create([
                'name'=>$tag
            ]);
        }

        // $faker = Faker::create();
        // for ($i = 1; $i <= 250; $i++) {
        //     ShopTag::create([
        //         'shop_id' => $i,
        //         'tag_id' => $faker->numberBetween(1,9)
        //     ]);
        // }
    }
}
