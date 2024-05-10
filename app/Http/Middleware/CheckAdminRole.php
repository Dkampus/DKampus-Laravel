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

        // Check if the user is authenticated and is an admin
        if ($user->role === 'customer') {
            return redirect()->route('homepage');
        } elseif ($user->role === 'courier') {
            return redirect()->route('dashboardCourier');
        }

        return $next($request);
    }
}
