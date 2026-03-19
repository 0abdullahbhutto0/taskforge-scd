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
        $attributes = request()->validate([
            'name'=>['required'],
            'email'=>['required', 'email', 'unique:users,email'],
            'password'=>['required', 'min:8', 'confirmed'],
            'plan'=>['required', 'in:free,pro,pro_plus']
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
            'status' => 'approved' // Automatically approve SaaS tenant owners
        ]);
      
        $role = Role::where('name', 'Manager')->first();
        if (!$role) {
            $role = Role::create(['name' => 'Manager']);
        }
        $user->roles()->attach($role->id);

        Auth::login($user);

        if ($attributes['plan'] === 'pro') {
            $priceId = env('STRIPE_PRO_PRICE_ID', 'price_dummy_pro');
            try {
                return request()->user()->newSubscription('pro', $priceId)->checkout([
                    'success_url' => url('/manager/dashboard?session_id={CHECKOUT_SESSION_ID}'),
                    'cancel_url' => url('/manager/dashboard'),
                ]);
            } catch (\Exception $e) {
                return redirect('/manager/dashboard')->with('error', 'Unable to redirect to Stripe: ' . $e->getMessage());
            }
        } elseif ($attributes['plan'] === 'pro_plus') {
            $priceId = env('STRIPE_PRO_PLUS_PRICE_ID', 'price_dummy_pro_plus');
            try {
                return request()->user()->newSubscription('pro_plus', $priceId)->checkout([
                    'success_url' => url('/manager/dashboard?session_id={CHECKOUT_SESSION_ID}'),
                    'cancel_url' => url('/manager/dashboard'),
                ]);
            } catch (\Exception $e) {
                return redirect('/manager/dashboard')->with('error', 'Unable to redirect to Stripe: ' . $e->getMessage());
            }
        }

        return redirect('/manager/dashboard')->with('success', 'Welcome to TaskForge! Your free workspace is ready.');
    }
}
