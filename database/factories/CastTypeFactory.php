<?php

namespace Database\Factories;

use App\Models\Cast;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class CastTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $castIDs  = Cast::pluck('id')->all();
        $typeIDs  = Type::pluck('id')->all();

        return [
            'cast_id' => $this->faker->randomElement($castIDs), 
            'type_id' => $this->faker->randomElement($typeIDs) 
        ];
    }
}
