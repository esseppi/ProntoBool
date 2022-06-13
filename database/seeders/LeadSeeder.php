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
        for ($i = 0; $i < 5; $i++) {
            Lead::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'message' => $faker->text(),
                //corretto errorProfileon numero a caso da corregere con valori corretti
                'profile_id' => Profile::inRandomOrder()->first()->id,
            ]);
        }
    }
}
