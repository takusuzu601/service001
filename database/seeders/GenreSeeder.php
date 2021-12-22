<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            '店舗型ヘルス','ホテヘル','デリヘル','ソープランド'
        ];

        foreach($genres as $genre){
            Genre::create([
                'name'=>$genre
            ]);
        }
    }
}
