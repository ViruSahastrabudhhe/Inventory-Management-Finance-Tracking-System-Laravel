<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller

{
    public function __invoke(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user=User::create($credentials);

        return redirect()->route('view-login')->with('success', 'User successfully registered!');
    }
}
