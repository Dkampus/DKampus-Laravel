<?php

// CheckAdminRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->restriction != 1) {
            if ($user->role === 'customer') {
                return redirect()->route('homepage');
            } elseif ($user->role === 'courier') {
                return redirect()->route('dashboardCourier');
            }
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your Account Has Been Banned');
        }

        return $next($request);
    }
}
