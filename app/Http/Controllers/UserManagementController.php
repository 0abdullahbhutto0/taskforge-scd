<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ManagerEmployeeModel;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole() !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }
        $users = User::with('roles')->latest()->simplePaginate(5); //Pagination task
        return view('admin.users', ['users' => $users]);
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();
        
        return redirect()->back()->with('success', 'User approved successfully');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->back()->with('success', 'User rejected and removed');
    }

    public function assignRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roleName = $request->input('role');
        
        $user->roles()->detach();
        
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $user->roles()->attach($role->id);
            $user->status = 'approved';
            $user->save();
        }
        
        return redirect()->back()->with('success', 'Role assigned successfully');
    }

    public function createEmployee(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'status' => 'approved',
        ]);

        ManagerEmployeeModel::create([
            'manager_id' => Auth::id(),
            'employee_id' => $user->id,
        ]);

        $employeeRole = Role::where('name', 'Employee')->first();
        if ($employeeRole) {
            $user->roles()->attach($employeeRole->id);
        }

        return redirect()->back()->with('success', 'Employee created successfully');
    }
}
