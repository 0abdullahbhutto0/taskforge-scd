<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\User;
use App\Models\ManagerEmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->hasRole();
        
        if ($role === 'Admin') {
            $workspaces = Workspace::with(['creator', 'users', 'tasks'])->latest()->simplePaginate(3); //Pagination task
        } elseif ($role === 'Manager') {
            $workspaces = Workspace::where('created_by', $user->id)
                ->with(['creator', 'users', 'tasks'])
                ->latest()
                ->simplePaginate(3); //Pagination task
        } else {
            $workspaces = $user->workspaces()->with(['creator', 'users', 'tasks'])->latest()->simplePaginate(3); //Pagination task
        }
        
        return view('workspaces.index', ['workspaces' => $workspaces]);
    }

    public function create()
    {
        $user = Auth::user();
        if($user->hasRole() !== 'Manager') {
            abort(403, 'Unauthorized action.');
        }
        $teamManager = ManagerEmployeeModel::where('manager_id', $user->id)->pluck('employee_id')->toArray();
        $employees = User::whereIn('id', $teamManager)->get();
        
        return view('workspaces.create', ['employees' => $employees]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'members' => ['nullable', 'array'],
        ]);

        $workspace = Workspace::create([
            'name' => $attributes['name'],
            'description' => $attributes['description'] ?? null,
            'created_by' => Auth::id(),
        ]);

        if ($request->has('members')) {
            $workspace->users()->attach($attributes['members']);
        }

        return redirect('/workspaces')->with('success', 'Workspace created successfully');
    }

    public function show($id)
    {
        $workspace = Workspace::with(['creator', 'users', 'tasks.assignedTo', 'tasks.creator'])->findOrFail($id);
        return view('workspaces.show', ['workspace' => $workspace]);
    }

}
