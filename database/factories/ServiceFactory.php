<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Service>
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = [
            ['name' => 'General Consultation', 'duration' => 30, 'price' => 50.00],
            ['name' => 'Pediatrics Checkup', 'duration' => 45, 'price' => 70.00],
            ['name' => 'Cardiology Review', 'duration' => 60, 'price' => 120.00],
            ['name' => 'Dermatology Visit', 'duration' => 30, 'price' => 80.00],
            ['name' => 'Dental Cleaning', 'duration' => 45, 'price' => 65.00],
            ['name' => 'Physiotherapy Session', 'duration' => 60, 'price' => 90.00],
        ];

        return fake()->randomElement($services);
    }
}
