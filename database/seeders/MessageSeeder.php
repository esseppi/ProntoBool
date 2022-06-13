<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\Professionist\Message;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Message::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'message' => $faker->text,
        ]);
    }
}
