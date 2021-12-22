<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CastImgFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'img_path'=>$this->faker->image('public/storage/castimgs',640,480,null,false)
        ];
    }
}
