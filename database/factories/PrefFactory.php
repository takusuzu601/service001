<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrefFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->prefecture();

        return [

        ];
    }
}
