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
        \App\Models\Movie::factory(5)->create()->each(function ($movie) {
            // Присваиваем случайные жанры фильму
            $genres = Genre::inRandomOrder()->limit(rand(1, 3))->get();
            $movie->genres()->attach($genres);
        });
    }
}
