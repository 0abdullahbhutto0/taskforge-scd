<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; 
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        if ($user->hasRole() === 'Admin') {
            return true;
        }
        if ($user->hasRole() === 'Manager' && $task->created_by === $user->id) {
            return true;
        }
        if ($user->hasRole() === 'Employee' && $task->assigned_to === $user->id) {
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
    public function update(User $user, Task $task): bool
    {
        if ($user->hasRole() === 'Admin') {
            return true;
        }
        return $user->hasRole() === 'Manager' && $task->created_by === $user->id;
    }

    /**
     * Determine whether the user can update the status of the task.
     */
    public function updateStatus(User $user, Task $task): bool
    {
        if ($user->hasRole() === 'Admin') {
            return true;
        }
        if ($user->hasRole() === 'Manager' && $task->created_by === $user->id) {
            return true;
        }
        // Employees can update status if it's assigned to them
        if ($user->hasRole() === 'Employee' && $task->assigned_to === $user->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        if ($user->hasRole() === 'Admin') {
            return true;
        }
        return $user->hasRole() === 'Manager' && $task->created_by === $user->id;
    }
}
