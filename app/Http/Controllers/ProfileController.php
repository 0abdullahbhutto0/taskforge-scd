<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ManagerEmployeeModel;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->hasRole();
        
        $planDetails = null;
        $managerDetails = null;

        if ($role === 'Manager') {
            if ($user->subscribed('pro_plus')) {
                $planDetails = 'Pro Plus Tier ($99/mo) - Unlimited users/workspaces';
            } elseif ($user->subscribed('pro')) {
                $planDetails = 'Pro Tier ($29/mo) - Up to 50 users/unlimited workspaces';
            } else {
                $planDetails = 'Free Tier ($0/mo) - 1 Workspace / 5 users limits';
            }
        } elseif ($role === 'Employee') {
            $managerRel = ManagerEmployeeModel::where('employee_id', $user->id)->first();
            if ($managerRel) {
                $managerDetails = User::find($managerRel->manager_id);
            }
        }

        return view('profile.index', [
            'user' => $user,
            'role' => $role,
            'planDetails' => $planDetails,
            'managerDetails' => $managerDetails
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:5120']
        ]);

        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
