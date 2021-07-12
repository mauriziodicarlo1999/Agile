<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Kind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function viewArtist($id){
    $artista = Artist::all()->
        where('id', $id)->first();
    $genere = DB::table('artists')->
        join('artists_kind','artists.id','=','artists_kind.id_artista')->
        join('kinds','kinds.id','=','artists_kind.id_genere')->
        select('kinds.nome as genere')->where('id_artista','=', $id)
        ->get();

    $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
    $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
    $evento = DB::table('events')->limit(3)->get();

    return view('artista', ['artista' => $artista,'generi' => $genere,'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento' => $evento]);
    }
    /*public function viewArtists(){
        $artists = DB::table('artists')->limit(6)->get();
        return view('dashboard',[ 'artists' => $artists]);
    }*/
}
