<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Quinten Buis',
            'email' => 'quinten.buis@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('quinten123'),
            'remember_token' => Str::random(10),
        ])->assignRole('super_admin');
    }
}
