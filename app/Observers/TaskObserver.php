<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        \App\Models\TaskActivity::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'description' => 'created_task',
            'new_values' => $task->getAttributes(),
        ]);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        if ($task->isDirty()) {
            \App\Models\TaskActivity::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'description' => 'updated_task',
                'old_values' => $task->getOriginal(),
                'new_values' => $task->getChanges(),
            ]);
        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
