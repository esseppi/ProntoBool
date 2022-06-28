<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\Professionist\Lead;
use App\Models\Professionist\Profile;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 1000; $i++) {
            $int = $faker->dateTimeBetween('-1 year', '-1 week');
            $string = date_format($int, "Y-m-d H:i:s");
            Lead::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'message' => $faker->text(10),
                'phone' => $faker->phoneNumber(),
                'profile_id' => Profile::inRandomOrder()->first()->id,
                'created_at' => $string,
            ]);
        }
    }
}
