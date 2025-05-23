<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    //
    public function index() {   
        return redirect(route('view-dashboard'))->with("error", "Please verify your email first!");
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect(route('view-dashboard'))->with("success", "Successfully verified your email!");
    }

    public function notify(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    }
}
