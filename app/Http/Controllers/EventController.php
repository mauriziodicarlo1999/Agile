<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Event;

use App\Models\Image;
use App\Models\Subevent;
use App\Models\User;
use Carbon\Carbon;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller {

    public function creaEvento (Request $request) {

        if ($request->data_ora_inizio >= $request->data_ora_fine)
            return view('creazione-evento', ["errore" => "La data di fine deve essere successiva alla data di inizio"]);

        if ($request->data_ora_inizio <= now())
            return view('creazione-evento', ["errore" => "L'evento deve iniziare in una data futura"]);

        $file = $request->file('copertina');
        $filename = $request->nome;
        $path = $file->storeAs('images', 'evento-'.$filename.'.png');

        Image::create([
            'path' => $path
        ]);

        $id = Image::all()->sortByDesc('id')->first()->id;

        Event::create([
            "nome" => $request->nome,
            "descrizione" => $request->descrizione,
            "citta" => $request->citta,
            "indirizzo" => $request->indirizzo,
            "data_ora_inizio" => $request->data_ora_inizio,
            "data_ora_fine" => $request->data_ora_fine,
            "tipologia" => $request->tipologia,
            "policy" => $request->policy,
            "max_iscritti" => $request->max_iscrizioni,
            "tipologia_iscrizione" => $request->tipologia_iscrizione,
            'stato' => 1,
            "prezzo" => $request->prezzo,
            "id_organizzatore" => Auth::user()->id,
            "id_copertina" => $id,
        ]);

        $id = Event::all()->sortByDesc('id')->first()->id;

        DB::table('artist_event')->insert([
            "id_evento" => $id,
            "id_artista" => $request->artista_principale
        ]);

        return view('creazione-evento', ["successo" => "L'evento è stato creato ed attualmente ed è stato inviato ad un amministratore per la revisione"]);

    }

    public function getEvents(){
        $eventi = DB::table('events')->where('stato',0)->orderBy('data_ora_inizio','desc')->paginate(8);
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento2 = DB::table('events')->limit(3)->get();
        return view('eventi', ['eventi' => $eventi,'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento2' => $evento2]);
    }

    public function getEvent($id){
        $evento = Event::all()->where('id',$id)->first();
        $sottoeventi = DB::table('subevents')->where('id_evento',$id)->get();
        $artisti = DB::table('events')->join('artist_event','events.id','=','artist_event.id_evento')
            ->join('artists','artist_event.id_artista','=','artists.id')->where('events.id','=',$id)
            ->select('artists.id as id','artists.nome_arte as anome_arte')->get();
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento1 = DB::table('events')->limit(3)->get();
        $offerte = DB::table('offerts')->where('id_evento',$id)->where('scadenza','>=', now() )->orderBy('scadenza','asc')->paginate(3);
        return view('evento',['evento'=>$evento, 'sottoeventi'=>$sottoeventi,'artisti'=>$artisti,'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento1' => $evento1,'offerte' => $offerte]);
    }

    public function AcquistoSimulato(Request $request){
        $evento = Event::all()->where('id',$request->id)->first();

        if($request->email != null) {
            $user = User::all()->where('email', $request->email)->first();
            if ($user == null)
                DB::table('users')->insert(["categoria" => 'not_user', "nome" => $request->nome, "email" => $request->email]);
            //  dd(0);
            $id = User::all()->where('email', $request->email)->first()->id;

            if (DB::table('inscriptions')->where('id_evento', $request->id)->where('id_utente', $id)->count() == 0) {
                DB::table('inscriptions')->insert(["id_evento" => $request->id, "id_utente" => $id, "biglietti_acquistati" => $request->counter]);
            } else {
                $bigliettiPrecedenti = DB::table('inscriptions')->where('id_utente', $id)->where('id_evento', $request->id)->first();
                $biglietti = $bigliettiPrecedenti->biglietti_acquistati + $request->counter;
                DB::table('inscriptions')->where('id_evento', $request->id)->where('id_utente', $id)->update(['biglietti_acquistati' => $biglietti]);
            }
            $data = array(
                'nome' => $request->nome,
                'numBiglietti' => $request->counter,
                'nomeEvento' => $evento->nome,
            );
            Mail::to($request->email)->send(new SendMail($data));
        }else {
            if (DB::table('inscriptions')->where('id_evento', $request->id)->where('id_utente', Auth::user()->id)->count() == 0) {
                DB::table('inscriptions')->insert(["id_evento" => $request->id, "id_utente" => Auth::user()->id, "biglietti_acquistati" => $request->counter]);
            } else {
                $bigliettiPrecedenti = DB::table('inscriptions')->where('id_utente', Auth::user()->id)->where('id_evento', $request->id)->first();
                $biglietti = $bigliettiPrecedenti->biglietti_acquistati + $request->counter;
                DB::table('inscriptions')->where('id_evento',$request->id)->where('id_utente',Auth::user()->id)->update(['biglietti_acquistati' => $biglietti]);
            }
            $data = array(
                'nome' => Auth::user()->nome." ".Auth::user()->cognome,
                'numBiglietti' => $request->counter,
                'nomeEvento' => $evento->nome,
            );
            Mail::to(Auth::user()->email)->send(new SendMail($data));
        }
        if(isset($request->sconto)){
            //qui calcolo la spesa totale con sconto
            $scontato = ($request->prezzo * $request->counter) / 100 ;
            $scontato = $scontato * $request->sconto;
            $spesaTotale = ($request->prezzo * $request->counter) - $scontato;
            ///dump($spesaTotale);
        } else {
            //qui calcolo la spesa totale senza sconto
            $spesaTotale = $request->prezzo * $request->counter;
            //dump($spesaTotale);
        }

        //da qui codice per google calendar
        $startTime = Carbon::parse($evento->data_ora_inizio);
        $endTime = Carbon::parse($evento->data_ora_fine);
        \Spatie\GoogleCalendar\Event::create([
            'name' => $evento->nome,
            'startDateTime' => $startTime,
            'endDateTime' => $endTime
        ]);

        return view('acquisto-simulato',['evento'=>$evento,'request'=>$request, 'spesaTotale' => $spesaTotale]);
    }

    public function ricerca(Request $request){
        $eventi = DB::table('events')->where('data_ora_inizio','>',$request->dataCerca)
            ->where('nome','like','%'.$request->nomeCerca.'%')->get();
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento2 = DB::table('events')->limit(3)->get();
        return view('eventi', ['eventi' => $eventi,'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento2' => $evento2]);
    }

    public function creaDettagliEventi (Request $request) {
        if ($request->action == "newArtist") {
            if (DB::table('artist_event')->where('id_evento', $request->id_evento)->where('id_artista', $request->artista)->count() > 0)
                return view('eventi-organizzati', ['errore' => 'Artista già presente nell\'evento']);
            DB::table('artist_event')->insert([
                'id_evento' => $request->id_evento,
                'id_artista' => $request->artista
            ]);
            return view('eventi-organizzati', ['successo' => 'Artista aggiunto all\'evento']);
        }else{
            $event = Event::all()->where('id', $request->id_evento)->first();
            if ($request->data_ora_inizio >= $request->data_ora_fine)
                return view('eventi-organizzati', ["errore" => "La data di fine deve essere successiva alla data di inizio"]);
            if ($event->data_ora_inizio > $request->data_ora_inizio)
                return view('eventi-organizzati', ['errore' => 'Data di inizio non valida']);
            if ($event->data_ora_fine < $request->data_ora_fine)
                return view('eventi-organizzati', ['errore' => 'Data di fine non valida']);
            Subevent::create([
                'titolo' => $request->titolo,
                'data_ora_inizio' => $request->data_ora_inizio,
                'data_ora_fine' => $request->data_ora_fine,
                'descrizione' => $request->descrizione,
                'id_evento' => $request->id_evento
            ]);
            return view('eventi-organizzati', ['successo' => 'Sottoevento aggiunto correttamente']);
        }
    }

}
