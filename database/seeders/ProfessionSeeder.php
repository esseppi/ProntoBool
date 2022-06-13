<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professionist\Profession;
use Faker\Generator as Faker;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 15; $i++) {
            Profession::create([
                'name' => $faker->jobTitle(),
            ]);
        }
        //dalla migrate   $table->string('name', 255)->nullable();
    }
}
