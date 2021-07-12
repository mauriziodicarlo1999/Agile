<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Image;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ListaEventiAdminController extends Controller
{
    public function listaEventi(){
        $evento = DB::table('events')->get();
        return view ('admin.events', ['evento' => $evento]);
    }

    public function singoloEvento($id){
        $evento = Event::all()->where('id', $id)->first();
        return view ('admin.evento', ['evento' => $evento]);
    }

    public function modifica($id){
        $evento = Event::all()->where('id', $id)->first();
        return view('admin.modifica-evento', ['evento' => $evento]);
    }
    public function modificaEvento(Request $request, $id) {
        if ($request->data_ora_inizio >= $request->data_ora_fine)
            return view('admin.modifica-evento', ['errore' => "La data di fine deve essere successiva alla data di inizio!"]);

        if ($request->data_ora_inizio <= now())
            return view('admin.modifica-evento', ['errore' => "L'evento deve iniziare in una data futura!"]);

        /*$file = $request->file('copertina');
        $filename = $request->nome;
        $path = $file->storeAs('images', 'evento-'.$filename.'.png');

        Image::updating([
            'path' => $path
        ]);

        $id = Image::all()->sortByDesc('id')->first()->id;*/

        Event::all()->where('id', $id)->each->update([
                "nome" => $request->nome,
                "descrizione" => $request->descrizione,
                "data_ora_inizio" => $request->data_ora_inizio,
                "data_ora_fine" => $request->data_ora_fine,
                "tipologia" => $request->tipologia,
                "policy" => $request->policy,
                "max_iscritti" => $request->max_iscritti,
                /*"id_copertina" => $id,*/
            ]);

        $evento = Event::all()->where('id', $id)->first();
        return view('admin.modifica-evento', ['evento' => $evento,'successo' => "L'evento è stato modificato con successo!"]);
    }

    public function elimina(Request $request){
        DB::table('events')->where('id', $request->id)->delete();
        return $this->listaEventi();
    }

    public function approvaEvento(Request $request) {
        Event::all()->where('id', $request->id)->each->update(["stato" => 0]);

        $event = Event::all()->where('id', $request->id)->first();
        foreach (User::all()->where('categoria', 'user') as $user) {
            $data = array(
                'action' => 'eventoApprovato',
                'evento' => $event->nome,
                'inizio' => $event->data_ora_inizio,
                'fine' => $event->data_ora_fine,
                'nome' => $user->nome." ".$user->cognome
            );
            Mail::to($user->email)->send(new SendMail($data));
        }
        return $this->singoloEvento($request->id);
    }
}
