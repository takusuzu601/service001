<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{

    protected $model = Shop::class;

    public function definition()
    {
        $name = $this->faker->sentence(1,3);

        return [
            'name'=>$name,
            'shop_phone'=>$this->faker->phoneNumber,
            'email'=>$this->faker->safeEmail,
            'password'=>bcrypt('12345678')
        ];
    }
}
