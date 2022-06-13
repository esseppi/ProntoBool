<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professionist\Review;
use Faker\Generator as Faker;
use App\Models\Professionist\Profile;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 4; $i++) {
            Review::create([
                'name' => $faker->name(),
                'profile_id' => Profile::inRandomOrder()->first()->id,
                'email' => $faker->email(),
                'message' => $faker->text(),
                'rating' => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
