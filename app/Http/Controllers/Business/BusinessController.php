<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function index() {
        return view("business.create");
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
        ]);

        $business = new Business;

        $business->name=$request->name;
        $business->email=$request->email;
        $business->phone=$request->phone;
        $business->address=$request->address;
        $business->country=$request->country;
        $business->user_id=Auth::id();

        $business->save();

        return redirect(route('view-dashboard'))->with('success', 'Business successfully registered! Please verify your email with the verification link we sent to your email!');
    }
}
