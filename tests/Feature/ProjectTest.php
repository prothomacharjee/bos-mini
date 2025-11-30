<?php

use App\Models\User;
use App\Models\Project;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;

it('creates a project successfully', function () {

    $user = User::factory()->create();

    $payload = [
        'title' => 'Test Project',
        'client' => 'Client A',
        'start_date' => '2024-01-01',
        'end_date' => '2024-01-10',
        'status' => 'active',
    ];

    $response = postJson('/api/projects', $payload, [
        'Authorization' => 'Bearer ' . $user->createToken('token')->plainTextToken
    ]);

    $response->assertCreated()
        ->assertJsonFragment(['title' => 'Test Project']);
});

it('retrieves a project with tasks using eager loading', function () {

    $user = User::factory()->create();

    $project = Project::factory()
        ->hasTasks(3)
        ->create();

    $response = getJson("/api/projects/{$project->id}", [
        'Authorization' => 'Bearer ' . $user->createToken('token')->plainTextToken
    ]);

    $response->assertOk()
        ->assertJsonStructure([
            'id',
            'title',
            'tasks' => [
                '*' => ['id', 'title', 'deadline', 'assigned_user', 'status']
            ]
        ]);
});
