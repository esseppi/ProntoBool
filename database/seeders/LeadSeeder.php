<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\Professionist\Lead;

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
                'name' => $faker->name,
                'email' => $faker->email,
                'message' => $faker->text,
                'profile_id' => 5,
            ]);
        }
    }
}
