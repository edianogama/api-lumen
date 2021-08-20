<?php

namespace Database\Seeders;

use App\Models\News;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class InsertNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0; $i < 15; $i++) {
            News::create([
                'title' => $faker->sentence(2),
                'subtitle' => $faker->sentence(5),
                'image_featured' => 'https://source.unsplash.com/random',
                'description' => $faker->text(),
            ]);
        }
    }
}
