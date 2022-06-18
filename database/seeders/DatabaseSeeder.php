<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $genres = array("Action & Adventure", "Animation", "Comedy", "Crime",
            "Documentary", "Drama", "Family", "Kids", "Mystery", "News",
            "Reality", "Sci-Fi & Fantasy", "Soap", "Talk",
            "War & Politics", "Western");

        foreach($genres as $genre){
            Genre::create(['genre' => $genre]);
        }
    }
}
