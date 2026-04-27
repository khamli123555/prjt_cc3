<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Seed the application's database with appointments.
     */
    public function run(): void
    {
        $patientIds = User::query()->where('role', 'patient')->pluck('id')->all();
        $doctorIds = User::query()->where('role', 'doctor')->pluck('id')->all();
        $serviceIds = Service::query()->pluck('id')->all();

        if ($patientIds === [] || $doctorIds === [] || $serviceIds === []) {
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            $startsAt = fake()->dateTimeBetween('now', '+30 days');

            Appointment::create([
                'user_id' => fake()->randomElement($patientIds),
                'doctor_id' => fake()->randomElement($doctorIds),
                'service_id' => fake()->randomElement($serviceIds),
                'date' => $startsAt,
                'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            ]);
        }
    }
}
