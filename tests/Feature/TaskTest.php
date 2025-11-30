<?php

use App\Models\User;
use App\Models\Project;
use function Pest\Laravel\postJson;

it('adds a task to a project', function () {

    $user = User::factory()->create();
    $assignedUser = User::factory()->create();

    $project = Project::factory()->create();

    $payload = [
        'title' => 'New Task',
        'deadline' => '2024-02-01',
        'assigned_user' => $assignedUser->id,
        'status' => 'pending',
    ];

    $response = postJson("/api/projects/{$project->id}/tasks", $payload, [
        'Authorization' => 'Bearer ' . $user->createToken('token')->plainTextToken
    ]);

    $response->assertCreated()
        ->assertJsonFragment(['title' => 'New Task']);

    $this->assertDatabaseHas('tasks', [
        'title' => 'New Task',
        'project_id' => $project->id
    ]);
});
