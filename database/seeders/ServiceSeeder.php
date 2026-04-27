<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the application's database with medical services.
     */
    public function run(): void
    {
        Service::factory()->count(10)->create();
    }
}
