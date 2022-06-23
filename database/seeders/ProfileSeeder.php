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
        $city = ['Reggio', 'Roma', 'Asti', 'Milano'];
        for ($i = 5; $i < $profNumb; $i++) {
            $page = file_get_contents("https://fakeface.rest/face/json");
            $decoded = json_decode($page,true); // decode the json record
            Profile::create([
                'id' => $i,
                'pic' => $decoded['image_url'],
                'user_id' => $i,
                'curriculum' => $faker->url(),
                'description' => $faker->text(),
                'address' => $city[rand(0, 3)],
                'phone' => $faker->phoneNumber(),
                'views' => $faker->numberBetween(0, 1000),
            ]);
        }
    }
}
