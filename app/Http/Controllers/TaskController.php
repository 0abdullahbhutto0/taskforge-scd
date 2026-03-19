<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use App\Models\Workspace;
use App\Models\User;
use App\Models\ManagerEmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->hasRole();

        $query = Task::with(['workspace', 'assignedTo', 'creator']);

        if ($role === 'Manager') {
            $query->where('created_by', $user->id);
        } elseif ($role !== 'Admin') {
            $query->where('assigned_to', $user->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->input('sort') === 'due_date') {
            $query->orderBy('due_date', 'asc');
        } else {
            $query->latest();
        }

        $tasks = $query->simplePaginate(10)->withQueryString();
        
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        $user = Auth::user();

        $workspaces = Workspace::where('created_by', $user->id)->get();
        $employeesAssoc = ManagerEmployeeModel::where('manager_id', $user->id)->pluck('employee_id')->toArray();
        $employees = User::whereIn('id', $employeesAssoc)->get();
        
        return view('tasks.create', [
            'workspaces' => $workspaces,
            'employees' => $employees,
        ]);
    }

    public function store(\App\Http\Requests\StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);
        $attributes = $request->validated();

        $task = Task::create([
            'workspace_id' => $attributes['workspace_id'],
            'title' => $attributes['title'],
            'description' => $attributes['description'] ?? null,
            'status' => $attributes['status'],
            'priority' => $attributes['priority'],
            'due_date' => $attributes['due_date'] ?? null,
            'assigned_to' => $attributes['assigned_to'],
            'created_by' => Auth::id(),
        ]);

        if ($task->assignedTo) {
            $task->assignedTo->notify(new \App\Notifications\TaskAssigned($task));
        }

        return redirect('/tasks')->with('success', 'Task created successfully');
    }

    public function show($id)
    {
        $task = Task::with(['workspace', 'assignedTo', 'creator', 'comments.user'])->findOrFail($id);
        $this->authorize('view', $task);
        return view('tasks.show', ['task' => $task]);
    }

    public function updateStatus(\App\Http\Requests\UpdateTaskStatusRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('updateStatus', $task);
        
        $oldStatus = $task->status->label();
        
        $task->status = $request->validated('status');
        $task->save();
        
        if ($task->creator) {
            $task->creator->notify(new \App\Notifications\TaskStatusUpdated($task, $oldStatus));
        }
        
        return redirect()->back()->with('success', 'Task status updated');
    }

    public function storeComment(Request $request, $id)
    {
        $attributes = $request->validate([
            'comment' => ['required', 'string'],
        ]);

        TaskComment::create([
            'task_id' => $id,
            'user_id' => Auth::id(),
            'comment' => $attributes['comment'],
        ]);

        $task = Task::findOrFail($id);
        
        // Notify assigne if comment is by creator, or notify creator if comment by assigne
        if ($task->assigned_to !== Auth::id() && $task->assignedTo) {
            $task->assignedTo->notify(new \App\Notifications\NewTaskComment($task, Auth::user()));
        } else if ($task->created_by !== Auth::id() && $task->creator) {
            $task->creator->notify(new \App\Notifications\NewTaskComment($task, Auth::user()));
        }

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function storeAttachment(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        $request->validate([
            'attachment' => ['required', 'file', 'max:10240'], // 10MB max
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName();
            $path = $file->store('task-attachments', 'public');

            $task->attachments()->create([
                'user_id' => Auth::id(),
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
            
            \App\Models\TaskActivity::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'description' => 'updated_task',
                'new_values' => ['Uploaded Attachment' => $filename],
            ]);
        }

        return redirect()->back()->with('success', 'Attachment uploaded successfully');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('delete', $task);
        $task->delete();
        
        return redirect('/tasks')->with('success', 'Task deleted successfully');
    }
}
