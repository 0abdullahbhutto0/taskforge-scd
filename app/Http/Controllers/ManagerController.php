<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workspace;
use  App\Models\ManagerEmployeeModel;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if($user->hasRole() !== 'Manager') {
            abort(403, 'Unauthorized action.');
        }

        $tasksDueToday = Task::where('assigned_to', $user->id)
            ->whereDate('due_date', today())
            ->count();

        $activeProjects = Workspace::where('created_by', $user->id)->count();
        $bottlenecks = Task::where('status', 'blocked')->count();

        $projects = Workspace::where('created_by', $user->id)
            ->with(['tasks', 'users'])
            ->get();

        $teamManager = ManagerEmployeeModel::where('manager_id', $user->id)->pluck('employee_id')->toArray();
        $teamMembers = User::whereIn('id', $teamManager)->get();

        $totalTasks = Task::where('created_by', $user->id)->count();
        $tasksCompleted = Task::where('status', 'completed')->where('created_by', $user->id)->count();

        $assocEmployees = ManagerEmployeeModel::where('manager_id', $user->id);

        return view('manager.dashboard', [
            'user' => $user,
            'tasksDueToday' => $tasksDueToday,
            'activeProjects' => $activeProjects,
            'bottlenecks' => $bottlenecks,
            'projects' => $projects,
            'teamMembers' => $teamMembers,
            'totalTasks' => $totalTasks,
            'tasksCompleted' => $tasksCompleted
        ]);
    }

    public function search()
    {
        $user = Auth::user();
        if ($user->hasRole() !== 'Manager') {
            abort(403, 'Unauthorized action.');
        }

        request()->validate([
            'search' => ['required', 'string', 'max:25', 'min:3'],
        ]);

        $tasks = Task::where('created_by', $user->id)
            ->where('title', 'like', '%' . request('search') . '%')
            ->with(['workspace', 'assignedTo'])
            ->latest()
            ->get();

        $workspaces = Workspace::where('created_by', $user->id)
            ->where('name', 'like', '%' . request('search') . '%')
            ->with(['users', 'tasks'])
            ->latest()
            ->get();

        $employeeManager = ManagerEmployeeModel::where('manager_id', $user->id)->pluck('employee_id')->toArray();
        $employees = User::whereIn('id', $employeeManager)
            ->where('name', 'like', '%' . request('search') . '%')
            ->latest()
            ->get(); 

        return view('manager.search', [
            'tasks' => $tasks,
            'workspaces' => $workspaces,
            'employees' => $employees,
            'query' => request('search'),
        ]);
    }
}
