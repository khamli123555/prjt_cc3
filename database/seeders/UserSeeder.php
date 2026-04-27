<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database with doctors and patients.
     */
    public function run(): void
    {
        User::factory()->count(6)->patient()->create();
        User::factory()->count(4)->doctor()->create();

        User::factory()->doctor()->create([
            'name' => 'Dr. Test User',
            'email' => 'doctor@example.com',
        ]);
    }
}
