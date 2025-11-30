<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence(3),
            'deadline' => now()->addDays(5)->format('Y-m-d'),
            'assigned_user' => User::factory(),
            'status' => 'pending',
        ];
    }
}
