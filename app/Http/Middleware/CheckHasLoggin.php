<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckHasLoggin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $user = Auth::user();
            if ($user != null) {
                if ($user && $user->role === 'courier') {
                    return redirect()->route('dashboardCourier');
                } elseif ($user->restriction == 1) {
                    Auth::logout();
                    return redirect('/masuk')->with('error', 'Your Account Has Been Banned');
                }
            }
        }

        return $next($request);
    }
}
