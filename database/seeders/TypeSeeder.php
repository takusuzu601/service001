<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'typeA', 'typeB', 'typeC', 'typeD', 'typeE', 'typeF', 'typeG', 'typeH', 'typeI'
        ];

        foreach ($types as $type) {
            Type::create([
                'name' => $type
            ]);
        }
    }
}
