<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Workspace;
use App\Models\ManagerEmployeeModel;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if($user->hasRole() !== 'Employee') {
            abort(403, 'Unauthorized action.');
        }
        
        return view('employee.dashboard', [
            'user' => $user,
        ]);
    }

    public function search()
    {
        $user = Auth::user();
        if ($user->hasRole() !== 'Employee') {
            abort(403, 'Unauthorized action.');
        }

        request()->validate([
            'search' => 'required|string|max:255',
        ]);

        $query = request('search');

        $tasks = Task::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->where('assigned_to', $user->id)
            ->get();
            $managerId = ManagerEmployeeModel::where('employee_id', $user->id)->value('manager_id');
        $workspaces = Workspace::where('name', 'like', "%{$query}%")
            ->where('created_by', $managerId)
            ->get();

        return view('employee.search', [
            'query' => $query,
            'tasks' => $tasks,
            'workspaces' => $workspaces,
        ]);
    }
}
