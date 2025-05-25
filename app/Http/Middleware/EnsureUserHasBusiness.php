<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasBusiness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $business = Business::where('user_id', '=', Auth::user()->id)->first();
        if (! empty($business)) {
            return $next($request);
        }

        return redirect()->route('view-create-business')->with('error', 'Please register your business first!');
    }
}
