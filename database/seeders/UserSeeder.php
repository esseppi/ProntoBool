<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Saso',
            'email' => 'esseppi@tutanota.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Ciaociao00'), // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Luigi',
            'email' => 'asd@asd.asd',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasdasd'), // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Anthony',
            'email' => 'ciao@ciao.it',
            'email_verified_at' => now(),
            'password' => Hash::make('Ciaociao00'), // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Cristian',
            'email' => 'ciao2@ciao.it',
            'email_verified_at' => now(),
            'password' => Hash::make('Ciaociao00'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
