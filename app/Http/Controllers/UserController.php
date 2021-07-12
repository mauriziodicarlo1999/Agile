<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller {

    public function modifica(Request $request) {
        if ($request->azione == "modificaProfilo") {
            Auth::user()->update([
                "telefono" => $request->telefono,
                "civico" => $request->civico,
                "citta" => $request->citta,
                "indirizzo" => $request->indirizzo
            ]);
        }else{
            if ($request->passwordNuova != $request->confermaPassword)
                return view('profilo', ['errore' => 'Le password non coincidono']);
            if (strlen($request->passwordNuova) < 8)
                return view('profilo', ['errore' => 'La password deve essere lunga almeno 8 caratteri']);
            Auth::user()->update([
                'password' => Hash::make($request->passwordNuova),
            ]);
        }
        return view('profilo', ['successo' => 'Campi modificati correttamente!']);
    }

}
