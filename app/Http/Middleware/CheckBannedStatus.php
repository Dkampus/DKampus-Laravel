<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckBannedStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        dd($user);
        // $restrict = User::find($id)->restriction;

        if ($user) {
            Auth::logout();
            return redirect('login')->with('message', 'Your Account Has Been Banned');
        }

        return $next($request);
    }
}
