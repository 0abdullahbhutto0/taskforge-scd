<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
