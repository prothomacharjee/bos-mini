<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'client' => $this->faker->company(),
            'start_date' => now()->subDays(5)->format('Y-m-d'),
            'end_date' => now()->addDays(10)->format('Y-m-d'),
            'status' => 'active',
        ];
    }
}
