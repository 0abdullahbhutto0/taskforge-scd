<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use App\Models\ManagerEmployeeModel;
use App\Models\Workspace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->hasRole();

    
        
        if ($role === 'Admin') {
            $tasks = Task::with(['workspace', 'assignedTo', 'creator'])->latest()->simplePaginate(3); //Pagination task
        } elseif ($role === 'Manager') {
            $tasks = Task::where('created_by', $user->id)
                ->with(['workspace', 'assignedTo', 'creator'])
                ->latest()
                ->simplePaginate(3); //Pagination task
        } else {
            $tasks = Task::where('assigned_to', $user->id)
                ->with(['workspace', 'assignedTo', 'creator'])
                ->latest()
                ->simplePaginate(3); //Pagination task
        }
        
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $user = Auth::user();
        if($user->hasRole() !== 'Manager') {
            abort(403, 'Unauthorized action.');
        }
        $workspaces = Workspace::where('created_by', $user->id)->get();
        $employeesAssoc = ManagerEmployeeModel::where('manager_id', $user->id)->pluck('employee_id')->toArray();
        $employees = User::whereIn('id', $employeesAssoc)->get();
        
        return view('tasks.create', [
            'workspaces' => $workspaces,
            'employees' => $employees,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'workspace_id' => ['required', 'exists:workspaces,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:todo,in_progress,review,completed,blocked'],
            'priority' => ['required', 'in:low,medium,high,critical'],
            'due_date' => ['nullable', 'date'],
            'assigned_to' => ['required', 'exists:users,id'],
        ]);

        Task::create([
            'workspace_id' => $attributes['workspace_id'],
            'title' => $attributes['title'],
            'description' => $attributes['description'] ?? null,
            'status' => $attributes['status'],
            'priority' => $attributes['priority'],
            'due_date' => $attributes['due_date'] ?? null,
            'assigned_to' => $attributes['assigned_to'],
            'created_by' => Auth::id(),
        ]);

        return redirect('/tasks')->with('success', 'Task created successfully');
    }

    public function show($id)
    {
        $task = Task::with(['workspace', 'assignedTo', 'creator', 'comments.user'])->findOrFail($id);
        return view('tasks.show', ['task' => $task]);
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        if($task->assigned_to !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $task->status = $request->input('status');
        $task->save();
        
        return redirect()->back()->with('success', 'Task status updated');
    }

    public function addComment(Request $request, $id)
    {
        $attributes = $request->validate([
            'comment' => ['required', 'string'],
        ]);

        TaskComment::create([
            'task_id' => $id,
            'user_id' => Auth::id(),
            'comment' => $attributes['comment'],
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }
}
