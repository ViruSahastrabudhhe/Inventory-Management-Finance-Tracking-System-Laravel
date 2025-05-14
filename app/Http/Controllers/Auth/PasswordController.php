<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function viewForgotPass() {
        return view('auth.forgotpass');
    }
    public function viewResetPass(String $email, String $token) {
        return view('auth.resetpass', ['email'=> $email, 'token' => $token]);
    }

    public function sendForgotPasswordRequest(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return redirect()->route('view-login')->with(['status' => __($status)]);
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PasswordReset) {
            return redirect()->route('view-login')->with('status', __($status));
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
