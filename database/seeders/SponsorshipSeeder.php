<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Sponsorship;
use Faker\Generator as Faker;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Sponsorship::create([
            'name' =>  'Gold',
            'duration' => '144 hours',
            'price' => 9.99,
        ]);
        Sponsorship::create([
            'name' =>  'Silver',
            'duration' => '72 hours',
            'price' => 5.99,
        ]);
        Sponsorship::create([
            'name' =>  'Bronze',
            'duration' => '24 hours',
            'price' => 2.99,
        ]);
    }
}
