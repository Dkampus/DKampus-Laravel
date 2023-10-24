<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisteredUserController extends Controller
{

    private $firebaseauth;
    public function __construct()
    {
        $this->firebaseauth = Firebase::auth();
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
        $validatorsRegister = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', "min:4", Rules\Password::defaults()],
        ]);


        try {
            // for creating user in the authentication firebase
            $createUser = $this->firebaseauth->createUserWithEmailAndPassword($validatorsRegister['email'], $validatorsRegister['password']);

            // adding re$request to firebase authentication
            $customClaims = [
                'name' =>  $validatorsRegister['name'],
                'role' => 'user',
            ];

            // to set the customClaims or set the intial re$request in firebase authentication
            $this->firebaseauth->setCustomUserClaims($createUser->uid, $customClaims);

            $request['password'] = Hash::make($validatorsRegister['password']);
            $request['uid'] = $createUser->uid;

            User::create($request->all());

            // flashing messageing use laracast/flash packagist for more info 
            flash("Registrasi berhasil");
        } catch (\Exception $errorRegister) {
            flash("Registrasi gagal, mohon coba lagi");
        }

        // redirect to the login page
        return redirect()->route('login');
    }
}
