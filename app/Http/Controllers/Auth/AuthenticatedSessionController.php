<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        $validatorsLogin = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
                $firebaseauth = Firebase::auth();
                $signInResult = $firebaseauth->signInWithEmailAndPassword($validatorsLogin['email'], $validatorsLogin['password']);

                // Get the user data from th authentication
                $user = $signInResult->data();

                $request->session()->regenerate();

                flash('Login berhasil');
                return redirect()->route('homepage');
            } else {
                throw new \Exception("Login gagal, mohon coba login kembali");
            }
        } catch (\Exception $errorsLogin) {
            flash("Login gagal, mohon coba login kembali");
            return redirect()->back();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
