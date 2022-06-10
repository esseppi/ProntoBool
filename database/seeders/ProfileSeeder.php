<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Professionist\Profile;
use Faker\Generator as Faker;


class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $profNumb = User::whereRaw('1 = 1')->count();
        for ($i = 1; $i < $profNumb; $i++) {
            Profile::create([
                'user_id' => $i,
                'curriculum' => $faker->url(),
                'pic' => $faker->url(),
                'address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
            ]);
        }
    }
}
