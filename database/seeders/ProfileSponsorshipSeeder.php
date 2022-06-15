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
        $data = date_create('2022-06-08 10:36:02');
        $data = date_format($data, "Y-m-d");
        Profile::find(5)->sponsorships()->attach(1, ['startDate' => $data, 'endDate' => $data, 'isActive' => 1]);

        for ($i = 0; $i < 20; $i++) {
            $startDate = now();
            $bundle = rand(1, 3);
            $sponsorshipChoose = Sponsorship::find($bundle);

            $duration = $sponsorshipChoose->duration;
            $endDate = date_add(now(), date_interval_create_from_date_string($duration));

            $profile_id = Profile::inRandomOrder()->first()->id;

            Profile::find($profile_id)->sponsorships()->attach($sponsorshipChoose['id'], ['startDate' => $startDate, 'endDate' => $endDate, 'isActive' => 1]);
        }
    }
}
