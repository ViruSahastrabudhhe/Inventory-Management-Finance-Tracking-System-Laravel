<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\RoleUser;
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
            'password' => ['required', 'min:8'],
        ]);

        $user=User::create($credentials);
        $this->createUser($user);
        // event(new Registered($user));

        Auth::login($user);

        return redirect(route('view-dashboard'))->with('success', 'User successfully registered! Please verify your email with the verification link we sent to your email!');
    }

    public function createUser(User $user) {
        $roleUser = new RoleUser;

        $roleUser->user_id = $user->id;
        $roleUser->role_id = 2;

        $roleUser->save();
    }
}
