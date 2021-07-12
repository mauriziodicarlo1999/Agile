<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /*function viewArtist($idArtist){
    database::table('artists')->where('id', $idArtist)->orderBy('nome')->limit(1)->get();
    return view('artista');
    }*/

    public function viewAll(){
        $artists = DB::table('artists')->limit(6)->get();
        // $genere  = DB::table('kinds')->where('id', $artists -> id)->select('kinds.nome')
        $artists = DB::table('artists')->
        join('artists_kind','artists.id','=','artists_kind.id_artista')->
        join('kinds','kinds.id','=','artists_kind.id_genere')->
        select('artists.*','kinds.nome as genere')->
        limit(6)->get();
        if (count($artists) < 3 ) $count = count($artists);
        else $count = 3;
        $events = DB::table('events')->
        where('stato','=','0')->
        where('data_ora_inizio','>',now())->
        orderBy('data_ora_inizio')->
        limit(3)->get();
        $topics = DB::table('topics')->
        orderBy('created_at')
        ->limit(3)->get();
        return view('dashboard',['artists' => $artists, 'events' => $events, 'topics' => $topics, 'count' => $count]);
    }
}
