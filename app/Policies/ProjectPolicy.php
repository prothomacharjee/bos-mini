<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return true; // or role check
    }

    public function create(User $user): bool
    {
        return true; // allow logged in users
    }

    public function update(User $user, Project $project): bool
    {
        return true;
    }
}
