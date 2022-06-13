<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professionist\Lead;
use Faker\Generator as Faker;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            Lead::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'message' => $faker->text,
            ]);
        }
    }
}
