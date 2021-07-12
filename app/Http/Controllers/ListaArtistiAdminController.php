<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Image;
use App\Models\Kind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ListaArtistiAdminController extends Controller
{
    public function listaArtisti(){
        $artists = DB::table('artists as a')->join('artists_kind as ak','ak.id_artista','=','a.id')->
            join('kinds as k','k.id','=','ak.id_genere')->select('a.*' , 'k.nome as genere')->get();

        return view ('admin.artists', ['artists' => $artists]);
    }

    public function singoloArtista($id){
        $artista = Artist::all()->where('id', $id)->first();

        $genere = DB::table('kinds as k')->join('artists_kind as ak','ak.id_genere','=','k.id')->
            join('artists as a','a.id','=','ak.id_artista')->select('k.nome as genere')->
            where('a.id',$id)->get();

        $eventi = DB::table('artists as a')->join('artist_event as ae','ae.id_artista','=','a.id')->
            join('events as e','e.id','=','ae.id_evento')->select('e.id','e.nome','e.citta','e.data_ora_inizio','e.tipologia','e.stato')->
            where('a.id',$id)->get();

        return view ('admin.artista', ['artista' => $artista, 'genere' => $genere, 'eventi' => $eventi]);
    }

    public function caricaArtista($id){
        $artista = Artist::all()->where('id', $id)->first();

        $generi = DB::table('kinds as k')->join('artists_kind as ak','ak.id_genere','=','k.id')->
                      join('artists as a','a.id','=','ak.id_artista')->select('k.id','k.nome as genere')->
                      where('a.id',$id)->get();

        $eventi = DB::table('artists as a')->join('artist_event as ae','ae.id_artista','=','a.id')->
                      join('events as e','e.id','=','ae.id_evento')->select('e.id','e.nome','e.citta','e.data_ora_inizio','e.tipologia','e.stato')->
                      where('a.id',$id)->get();

        return view ('admin.modifica-artista', ['artista' => $artista,'generi'=>$generi, 'eventi'=>$eventi]);
    }

    public function modificaArtista (Request $request, $id)
    {

        if ($request->data_di_nascita >= now())
            return view('admin.modifica-artista', ["errore" => "Errore nella data di nascita inserita"]);

        /*$file = $request->file('copertina');
        $filename = $request->nome;
        $path = $file->storeAs('images', 'artista-'.$filename.'.png');

        Image::updating([
            'path' => $path
        ]);

        $id = Image::all()->sortByDesc('id')->first()->id;*/
        Artist::all()->where('id', $id)->each->update([
            "nome" => $request->nome,
            "cognome" => $request->cognome,
            "nome_arte" => $request->nome_arte,
            "biografia" => $request->biografia,
            "data_di_nascita" => $request->data_di_nascita,
            "luogo_di_nascita" => $request->luogo_di_nascita,
            "id_copertina" => 1,
        ]);

        $artista = Artist::all()->where('id', $id)->first();

        $generi = DB::table('kinds as k')->join('artists_kind as ak','ak.id_genere','=','k.id')->
                      join('artists as a','a.id','=','ak.id_artista')->select('k.id','k.nome as genere')->
                      where('a.id',$id)->get();

        $eventi = DB::table('artists as a')->join('artist_event as ae','ae.id_artista','=','a.id')->
                      join('events as e','e.id','=','ae.id_evento')->select('e.id','e.nome','e.citta','e.data_ora_inizio','e.tipologia','e.stato')->
                      where('a.id',$id)->get();

        return view('admin.modifica-artista', ["artista" => $artista, "generi" => $generi, "eventi" => $eventi, "successo" => "L'Artista è stato modificato con successo",'artista' => $artista]);
    }

    public function aggiungiArtista (Request $request) {
        if ($request->data_di_nascita >= now() )
            return view('admin.aggiungi-artista', ["errore" => "La data di nascita deve essere precedente a quella attuale"]);

        $file = $request->file('copertina');
        $filename = $request->nome;
        $path = $file->storeAs('images', 'artista-'.$filename.'.png');

        Image::create([
            'path' => $path
        ]);

        $id = Image::all()->sortByDesc('id')->first()->id;

        Artist::create([
            "nome" => $request->nome,
            "cognome" =>$request->cognome,
            "nome_arte" => $request->nomeArte,
            "data_di_nascita" => $request->data_di_nascita,
            "luogo_di_nascita" => $request->luogo_di_nascita,
            "biografia" => $request->biografia,
            "id_copertina" => $id,
            "created_at" => now(),
        ]);

        $artista = Artist::all()->sortByDesc('id')->first();
        DB::table('artists_kind')->insert([
            "id_artista" => $artista->id,
            "id_genere" => $request->genere,
        ]);

        return view('admin.aggiungi-artista', ["successo" => "L'Artista è stato aggiunto con successo!"]);
    }

    public function eliminaArtista(Request $request){
        DB::table('artists')->where('id', $request->id)->delete();
        return $this->listaArtisti();
    }
}
