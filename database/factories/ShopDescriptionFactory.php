<?php

namespace Database\Factories;

use App\Models\ShopDescription;
use Illuminate\Database\Eloquent\Factories\Factory;


class ShopDescriptionFactory extends Factory
{
    protected $model = ShopDescription::class;

    public function definition()
    {

        return [
            'shop_description'=>$this->faker->text()
        ];
    }
}
