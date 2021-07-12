<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function visualizzaTopics(){
        $topics = DB::table('topics')->orderBy('created_at', 'asc')->get();
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento = DB::table('events')->limit(3)->get();
        return view ('topics', ['varTopics' => $topics, 'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento' => $evento ]);
    }

    public function visualizzaTopic($id){
        $topic = Topic::all()->where('id', $id)->first();
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento = DB::table('events')->limit(3)->get();
        return view ('topic', ['topic' => $topic, 'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento' => $evento ]);
    }

    public function inserisciCommento(Request $request, $id){
        Comment::create([
            "nome_mittente" => $request->nome . " " . $request->cognome,
            "email_mittente" => $request->email,
            "testo" => $request->messaggio,
            "id_topic" => $id
        ]);
        return $this->visualizzaTopic($id);
    }


    public function creazioneTopic(Request $request) {

        if ($request->titolo == null){
            return view('creazione-topic', ["errore" => "Non è stato inserito nessun titolo per il Topic!"]);
        }

        /*$file = $request->file('copertina');
        $filename = $request->titolo;
        $path = $file->storeAs('images', 'topic-'.$filename.'.png');

        Image::create([
            'path' => $path
        ]);

        $id = Image::all()->sortByDesc('id')->first()->id;*/

        Topic::create([
            "titolo" => $request->titolo,
            "descrizione" => $request->descrizione,
            "id_creatore" => Auth::user()->id,
            "id_copertina" => 1
        ]);

        return view('creazione-topic', ["successo" => "Il topic è stato creato con successo!"]);
    }

    public function ricercaTopics(Request $request){
        $topics = DB::table('topics')->where('titolo', 'like', '%'.$request->ricerca.'%')->get();
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento = DB::table('events')->limit(3)->get();
        return view ('topics', ['varTopics' => $topics, 'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento' => $evento ]);
    }
}
