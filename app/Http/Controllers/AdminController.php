<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workspace;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if($user->hasRole() !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $totalUsers = User::count();
        $pendingUsers = User::where('status', 'pending')->count();
        $activeWorkspaces = Workspace::count();
        $totalTasks = Task::count();
        
        $recentUsers = User::with('roles')->latest()->take(5)->get();
        
        return view('admin.dashboard', [
            'user' => $user,
            'totalUsers' => $totalUsers,
            'pendingUsers' => $pendingUsers,
            'activeWorkspaces' => $activeWorkspaces,
            'totalTasks' => $totalTasks,
            'recentUsers' => $recentUsers,
        ]);
    }

    public function search()
    {
        $user = Auth::user();
        if ($user->hasRole() !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        request()->validate([
            'search' => 'required|string|max:255',
        ]);

        $query = request('search');

        $workspaces = Workspace::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->with('creator')
            ->get();

        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();


        return view('admin.search', [
            'workspaces' => $workspaces,
            'employees' => $users,
            'query' => $query,
        ]);
    }
}
