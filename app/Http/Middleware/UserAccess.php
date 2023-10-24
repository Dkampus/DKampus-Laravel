<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $uuid = Auth::user()->uid;
        $user = Firebase::auth()->getUser($uuid);
        $userClaims = $user->customClaims;

        if ($userClaims['role'] == $role || $userClaims['role'] == 'admin') {
            return $next($request);
        }

        flash("Hak akses tidak memenuhi syarat.");
        return redirect()->back();
    }
}