<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RicercaController extends Controller {

    public function ricercaCompleta (Request $request) {
        $events = DB::table('events')->where('nome','like','%'.$request->search.'%')->get();
        $artists = DB::table('artists')->where('nome','like','%'.$request->search.'%')->get();
        $topics = DB::table('topics')->where('titolo','like','%'.$request->search.'%')->get();
        return view('ricerca', [
            "search" => $request->search,
            "events" => $events,
            "artists" => $artists,
            "topics" => $topics
        ]);
    }

}
