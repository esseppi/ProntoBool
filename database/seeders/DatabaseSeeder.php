<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
        User::factory(10)->create();
        $this->call(ProfileSeeder::class);
        $this->call(ProfessionProfileSeeder::class);

        // \App\Models\Professionist\Profile::factory($profNumb)->create();
    }
}
