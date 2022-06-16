<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Professionist\Profession;
use App\Models\Professionist\Service;
use App\Models\Professionist\Profile;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database Faker $fakerseeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $numbProf = Profession::all()->count();
        for($i = 0; $i < 20; $i++)
        {
            Service::create([
                'profile_id' => Profile::inRandomOrder()->first()->id,
                'desc' => $faker->text(),
                'price' => $faker->randomFloat(2, 1, 100),
                'profession_id' => rand(1, $numbProf),
            ]);
        }
    }
}
