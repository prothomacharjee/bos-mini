<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create', Project::class);

        $project = Project::create($request->validated());

        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return response()->json(
            $project->load('tasks.user')
        );
    }
}

