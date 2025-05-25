<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Business;
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

        $findUser = User::where('email', '=', $request->email)->first();
        if (! empty($findUser)) {
            return back()->with('error', 'The provided credentials do not match our records.');
        }
        
        $user=User::create($credentials);
        $this->createManager($user);
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('view-create-business'))->with('success', 'User successfully registered!');
    }

    public function createManager(User $user) {
        $roleUser = new RoleUser;

        $roleUser->user_id = $user->id;
        $roleUser->role_id = 2;

        $roleUser->save();
    }
}
