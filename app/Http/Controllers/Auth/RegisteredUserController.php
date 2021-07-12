<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {

        if ($request->password != $request->confPassword)
            return view("auth.register", ["errore" => "Le due password non coincidono."]);

        if (strlen($request->password) < 8)
            return view("auth.register", ["errore" => "La password deve essere lunga almeno 8 caratteri."]);

        if (User::all()->where('email', $request->email)->count() != 0)
            return view("auth.register", ["errore" => "Email già in uso."]);

        $user = User::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'email' => $request->email,
            'data_di_nascita' => $request->nascita,
            'telefono' => $request->telefono,
            'citta' => $request->citta,
            'indirizzo' => $request->indirizzo,
            'civico' => $request->civico,
            'categoria' => 'user',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
