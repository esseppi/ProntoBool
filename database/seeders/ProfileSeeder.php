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
        for ($i = 5; $i < $profNumb; $i++) {
            Profile::create([
                'id' => $i,
                'pic' => $faker->url(),
                'user_id' => $i,
                'curriculum' => $faker->url(),
                'description' => $faker->text(),
                'address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
            ]);
        }
    }
}
