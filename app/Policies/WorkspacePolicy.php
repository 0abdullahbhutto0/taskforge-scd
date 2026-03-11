<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Access\Response;

class WorkspacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Handled by controller queries
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Workspace $workspace): bool
    {
        if ($user->hasRole() === 'Admin') {
            return true;
        }
        if ($user->hasRole() === 'Manager' && $workspace->created_by === $user->id) {
            return true;
        }
        if ($user->hasRole() === 'Employee' && $workspace->users()->where('user_id', $user->id)->exists()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole() === 'Manager';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Workspace $workspace): bool
    {
        if ($user->hasRole() === 'Admin') {
            return true;
        }
        return $user->hasRole() === 'Manager' && $workspace->created_by === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workspace $workspace): bool
    {
        if ($user->hasRole() === 'Admin') {
            return true;
        }
        return $user->hasRole() === 'Manager' && $workspace->created_by === $user->id;
    }
}
