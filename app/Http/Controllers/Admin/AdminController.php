<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return view("admin.index");
    }

    public function activate($userID) {
        $user = User::where("id", '=', $userID)->first();
        if ($user->is_activated==1) {
            $user->is_activated = 0;
            $user->save();
            return redirect()->back()->with('success','User deactivated!');
        } else {
            $user->is_activated = 1;
            $user->save();
            return redirect()->back()->with('success','User activated!');
        }

    }
}
