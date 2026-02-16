<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\LowercaseEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(RouteServiceProvider::HOME);
    // }

    public function store(Request $request)
    {
       $request->validate([
        'name'         => ['required', 'string', 'max:255'],
        'email'        => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users',
            new LowercaseEmail,   // ← utilise la règle ici
        ],
        'password'     => ['required', 'confirmed', 'min:8'],
        'contact_name' => ['required', 'string', 'max:255'],
        'address'      => ['required', 'string', 'max:255'],
        'region'       => ['required', 'string', 'max:100'],
        'whatsapp'     => ['required', 'string', 'max:20'],
    ]);

    $user = User::create([
        'name'         => $request->name,
        'email'        => $request->email,
        'password'     => Hash::make($request->password),
        'role'         => 'user',
        'contact_name' => $request->contact_name,
        'address'      => $request->address,
        'region'       => $request->region,
        'whatsapp'     => $request->whatsapp,
    ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
