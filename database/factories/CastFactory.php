<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CastFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();

        return [

            'name'=>$name,
            'cast_description'=>$this->faker->text()

        ];
    }
}
