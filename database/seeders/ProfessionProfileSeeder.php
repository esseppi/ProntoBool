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

        for ($i = 5; $i < $numProfile; $i++) {
            $profession = Profession::inRandomOrder()->limit(rand(0, 3))->get();
            Profile::find($i)->professions()->attach($profession->pluck('id')->all());
        }
    }
}
