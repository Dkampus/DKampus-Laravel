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
        if ($user != null) {
            if ($user && $user->role === 'courier') {
                return redirect()->route('dashboardCourier');
            } elseif ($user->restriction == 1) {
                Auth::logout();
                return redirect('/masuk')->with('error', 'Your Account Has Been Banned');
            }
        }

        // if ($user) {
        //     if ($user->restriction != 1) {
        //         return redirect()->route('dashboardCourier');
        //     } else {
        //         Auth::logout();
        //         return redirect()->route('login')->with('error', 'Your Account Has Been Banned');
        //     }
        // }

        return $next($request);
    }
}
