<?php

// CheckCourierRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCourierRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect unauthenticated users to the login page or any other appropriate page
            return redirect('/login');
        }

        // Get the authenticated user
        $user = Auth::user();

        if ($user->restriction != 1) {
            // Check if the user is not a courier
            if ($user->role === 'customer') {
                return redirect()->route('homepage');
            } elseif ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your Account Has Been Banned');
        }


        // User is a courier, continue with the request
        return $next($request);
    }
}
