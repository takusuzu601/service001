<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shopIDs  = Shop::pluck('id')->all();
        $tagIDs  = Tag::pluck('id')->all();

        return [
            'shop_id' => $this->faker->randomElement($shopIDs), 
            'tag_id' => $this->faker->randomElement($tagIDs) 
        ];
    }
}
