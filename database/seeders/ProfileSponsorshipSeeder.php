<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professionist\Profile;
use App\Models\Professionist\Sponsorship;

class ProfileSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            $startDate = now();
            $bundle = rand(1, 3);
            $sponsorshipChoose = Sponsorship::find($bundle);

            $duration = $sponsorshipChoose->duration;
            $endDate = date_add(now(), date_interval_create_from_date_string($duration));

            $profile_id = Profile::inRandomOrder()->first()->id;

            Profile::find($profile_id)->sponsorships()->attach($sponsorshipChoose['id'], ['startDate' => $startDate, 'endDate' => $endDate]);
        }
    }
}
