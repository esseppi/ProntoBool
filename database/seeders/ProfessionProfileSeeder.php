<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Profession;

class ProfessionProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = Profile::all();
        $numProfile = $profiles->count();
        foreach ($profiles as $profile) {
            $profession = Profession::inRandomOrder()->limit(rand(1, 2))->get();

            $profile->professions()->attach($profession);
            # code...
        }

        // for ($i = 5; $i < count($profiles); $i++) {
        //     $profession = Profession::inRandomOrder()->limit(rand(1, 2))->get();

        //     Profile::find($i)->professions()->attach($profession->pluck('id')->all());
        // }
    }
}
