<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Image;
use App\Models\Offert;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class ListaOfferteAdminController extends Controller {

    public function listaOfferte(){
        $offerts = Offert::all();
        return view ('admin.pricing', ['offerts' => $offerts]);
    }

    public function aggiungiOfferta (Request $request) {

        if ($request->scadenza <= now())
            return view('admin.aggiungi-pricing', ["errore" => "La data di scadenza è passata"]);

        Offert::create([
            "titolo" => $request->titolo,
            "scadenza" => $request->scadenza,
            "sconto" => $request->sconto,
            "id_evento" => $request->evento,
        ]);
        return $this->listaOfferte();

    }

    public function viewModifica ($id) {
        $offert = Offert::all()->where('id', $id)->first();
        return view('admin.modifica-pricing', ['offert' => $offert, 'id' => $id]);
    }

    public function modificaOfferta (Request $request, $id) {
        if ($request->scadenza <= now())
            return view('admin.modifica-pricing', ["errore" => "La data di scadenza è passata", 'id' => $id]);

        Offert::all()->where('id', $id)->each->update([
            "titolo" => $request->titolo,
            "scadenza" => $request->scadenza,
            "sconto" => $request->sconto,
            "id_evento" => $request->evento,
        ]);

        return $this->listaOfferte();
    }

    public function eliminaOfferta (Request $request) {
        DB::table('offerts')->where('id', $request->id)->delete();
        return $this->listaOfferte();
    }

}
