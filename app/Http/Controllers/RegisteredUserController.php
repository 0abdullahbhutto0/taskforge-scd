<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('/register');
    }

    public function store(){
       $attributes =  request()->validate([
            'name'=>['required'],
            'email'=>['required', 'email', 'unique:users,email'],
            'password'=>['required', 'min:8']
       ]);

      $user =  User::create([
          'name' => $attributes['name'],
          'email' => $attributes['email'],
          'password' => $attributes['password'],
          'status' => 'pending'
      ]);
      
      $role = Role::where('name', 'Unassigned')->first();
      if (!$role) {
          $role = Role::create(['name' => 'Unassigned']);
      }
      if ($role) {
          $user->roles()->attach($role->id);
      }
      
      return redirect('/login')->with('success', 'Registration successful! Please wait for admin approval.');
    }
}
