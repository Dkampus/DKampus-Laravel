<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
// use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisteredUserController extends Controller
{

    // private $firebaseauth;
    public function __construct()
    {
        // $this->firebaseauth = Firebase::auth();
    }
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'nama_user' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->phone_number,
                'password' => Hash::make($request->password),
                'role' => "customer"
            ]);
            DB::commit();
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            flash('Gagal mendaftar, silahkan coba lagi')->error();
            return redirect()->back();
        }

        event(new Registered($user));

        // Auth::login($user);

        flash('Berhasil melakukan mendaftar')->success();
        return redirect()->route('login');
    }
}
