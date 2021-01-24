<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name' => 'Paul Baars',
            'email' => 'pv.baars@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('paul123'),
            'remember_token' => Str::random(10),
        ])->assignRole('writer');

        User::create([
            'name' => 'Jozua Baars',
            'email' => 'jozuabaars@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('jozua123'),
            'remember_token' => Str::random(10),
        ])->assignRole('writer');
    }
}
