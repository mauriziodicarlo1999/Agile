<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtentiAdmin extends Controller {

    public function changeCategoria(Request $request) {
        $id = $request->user;
        if ($request->action == "insertAdmin")
            User::all()->where('id', $id)->each->update(["categoria" => "admin"]);
        else
            User::all()->where('id', $id)->each->update(["categoria" => "user"]);
        return view('admin.gestione-utenti');
    }

}
