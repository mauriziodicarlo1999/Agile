<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Image;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListaPrenotazioniAdminController extends Controller
{
    public function viewPrenotazioni($id){
        $evento = Event::all()->where('id', $id)->first();
        $acquistati = DB::table('inscriptions')->where('id_evento', $id)->get();
        $num = 0;
        foreach ($acquistati as $item) $num += $item->biglietti_acquistati;
        return view ('admin.prenotazioni', ['evento' => $evento, 'id' => $id, 'num' => $num, 'biglietti'=> $acquistati]);
    }
}
