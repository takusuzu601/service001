<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/shopimgs');
        Storage::deleteDirectory('public/castimgs');

        Storage::makeDirectory('public/shopimgs');
        Storage::makeDirectory('public/castimgs');

        $this->call(TagSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PrefSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(ShopTagSeeder::class);
        $this->call(CastTypeSeeder::class);
        
    }
}
