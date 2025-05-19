<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller

{
    public function index() {
        return view('auth.register');
    }
    
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user=User::create($credentials);
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('view-dashboard')->with('success', 'User successfully registered!');
    }
}
