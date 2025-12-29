<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('login');
    }
    public function store(){
        $attributes = request()->validate([
            "email"=>['required', 'email'],
            "password"=>['required']
        ]);
        
        if(!Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email'=>'Sorry, credentials dont match'
            ]);
        }
        
        $user = Auth::user();
        
        // Check if user is approved
        if($user->hasRole() === 'Unassigned'){
            Auth::logout();
            throw ValidationException::withMessages([
                'email'=>'Your account is pending approval. Please wait for admin approval.'
            ]);
        }
        
        request()->session()->regenerate();
        return redirect('/dashboard');
    }
    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
