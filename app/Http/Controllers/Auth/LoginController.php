<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

// use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validator for login
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

                flash('Login berhasil');
                return redirect()->route('homepage', compact('user'));
            }
        } catch (\Exception $errorsLogin) {
            flash("Login gagal, mohon coba login kembali");
            return redirect()->back();
        }
    }

    function authenticated(Request $request, $user)
    {
        if ($user->akses == 'operator' || $user->akses == 'admin') {
            return redirect()->route('operator.beranda');
        } elseif ($user->akses == 'wali') {
            return redirect()->route('wali.beranda');
        } else {
            Auth::logout();
            flash('access-error', 'Your account does not have access.');
            return redirect()->route('login');
        }
    }
}
