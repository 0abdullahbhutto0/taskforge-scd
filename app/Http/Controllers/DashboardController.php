<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function create(){
        $user = Auth::user();
        $role = $user->hasRole();
        
        // Check if user is approved
        if ($user->status !== 'approved') {
            return view('dashboard', ['user' => $user]);
        }
        
        // Redirect based on role
        if ($role === 'Admin') {
            return redirect('/admin/dashboard');
        } elseif ($role === 'Manager') {
            return redirect('/manager/dashboard');
        } elseif ($role === 'Employee') {
            return redirect('/employee/dashboard');
        } else {
            // User is approved but has no valid role assigned
            return view('dashboard', ['user' => $user]);
        }
    }
}
