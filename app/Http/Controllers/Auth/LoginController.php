<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = RoleUser::where('user_id', Auth::id())->pluck('role_id')[0];
            if ($user==2) {
                return redirect(route('view-dashboard'))->with("success", 'Successfully logged in!');
            }
            if ($user==1) {
                return redirect(route('view-admin-dashboard'))->with("success", 'Successfully logged in!');
            }
            return redirect()->intended('/dashboard')->with("success", 'Successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
