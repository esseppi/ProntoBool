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
        for ($i = 0; $i < 800; $i++) {
            $int = $faker->dateTimeBetween('-1 year', '-1 week');
            $string = date_format($int, "Y-m-d H:i:s");
            Review::create([

                'profile_id' => Profile::inRandomOrder()->first()->id,
                'name' => $faker->name(),
                'email' => $faker->email(),
                'message' => $faker->text(),
                'vote' => $faker->numberBetween(1, 5),
                'vote' => $faker->numberBetween(1, 5),
                'created_at' => $string
            ]);
        }
    }
}
