<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = RoleUser::where('user_id','=', Auth::id())->pluck('role_id')[0];
        if ($user==1 && $user!=2) {
            return redirect()->route("view-admin-dashboard")->with("error", "Invalid input! Error no.: 114");
        }
        if ($user!=2) {
            return redirect()->route("view-dashboard")->with("error", "Invalid input! Error no.: 114");
        }
        return $next($request);
    }
}
