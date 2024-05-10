<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomerRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user is authenticated and is a customer
        if ($user && $user->role === 'courier') {
            return redirect()->route('dashboardCourier');
        }

        return $next($request);
    }
}
