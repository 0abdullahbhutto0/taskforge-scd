<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\User;
use App\Models\ManagerEmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WorkspaceController extends Controller
{
    use AuthorizesRequests;
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
        $this->authorize('create', Workspace::class);
        $user = Auth::user();

        $teamManager = ManagerEmployeeModel::where('manager_id', $user->id)->pluck('employee_id')->toArray();
        $employees = User::whereIn('id', $teamManager)->get();
        
        return view('workspaces.create', ['employees' => $employees]);
    }

    public function store(\App\Http\Requests\StoreWorkspaceRequest $request)
    {
        $this->authorize('create', Workspace::class);
        $user = Auth::user();

        // Check Multi-Tenancy Subscription Limits
        if ($user->hasRole() === 'Manager') {
            $isPaid = $user->subscribed('pro') || $user->subscribed('pro_plus');
            if (!$isPaid && $user->createdWorkspaces()->count() >= 1) {
                return redirect('/workspaces')->with('error', 'Free tier is limited to 1 Workspace. Upgrade your plan to create unlimited workspaces.');
            }
        }

        $attributes = $request->validated();

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
        $this->authorize('view', $workspace);
        return view('workspaces.show', ['workspace' => $workspace]);
    }

    public function destroy($id)
    {
        $workspace = Workspace::findOrFail($id);
        $this->authorize('delete', $workspace);
        $workspace->delete();
        
        return redirect('/workspaces')->with('success', 'Workspace deleted successfully');
    }

}
