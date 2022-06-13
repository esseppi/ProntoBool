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
        for ($i = 0; $i < 5; $i++) {
            $startDate = now();
            $bundle = rand(1, 3);
            $profile_id = Profile::inRandomOrder()->first();
            if ($bundle == 1) {
                $addTime = "24 hour";
                # code...
            } else if ($bundle == 2) {
                $addTime = "72 hour";
                # code...
            } else if ($bundle == 3) {
                $addTime = "144 hour";
                # code...
            }
            Sponsorship::create([
                'profile_id' =>  $profile_id->id,
                'startDate' => $startDate,
                'bundle' => $bundle,
                'endDate' => date_add(now(), date_interval_create_from_date_string("40 days")),
            ]);
        }
    }
}
