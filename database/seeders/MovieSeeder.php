<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Movie::factory(100)->create()->each(function ($movie) {
            $genres = Genre::get()->random( rand( 1, 3 ) );
            $movie->genres()->attach($genres);
        });
    }
}
