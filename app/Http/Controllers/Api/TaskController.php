<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Jobs\SendTaskCreatedMail;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request, Project $project)
    {
        $task = Task::create([
            ...$request->validated(),
            'project_id' => $project->id
        ]);

        SendTaskCreatedMail::dispatch($task);

        return response()->json($task, 201);
    }
}

