<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InsertEventSeeder extends Seeder
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
            Event::create([
                'name' => $faker->sentence(2),
                'subtitle' => $faker->sentence(6),
                'resume' => $faker->sentence(10),
                'description' => $faker->text(),
                'date_start' => $faker->dateTimeBetween('now', '+1year'),
                'image_featured' => 'https://source.unsplash.com/random',
            
            ]);
        }
    }
}
