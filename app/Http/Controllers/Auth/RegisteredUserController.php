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
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'no_telp' => ['required', 'string', 'max:13', 'unique:' . User::class],
            ]);

            $user = User::create([
                'nama_user' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => Hash::make($request->password),
                'role' => "customer"
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Berhasil melakukan mendaftar');
    }
}
