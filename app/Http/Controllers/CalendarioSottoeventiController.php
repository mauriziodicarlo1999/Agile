<?php


namespace App\Http\Controllers;


use App\Models\Subevent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CalendarioSottoeventiController extends Controller
{
    //Per visualizzare il singolo sottoevento
    public function getSubevent($id) {
        $sottoevento = Subevent::all()->where('id',$id)->first();
        $eventoPrincipale = DB::table('subevents')->join('events','subevents.id_evento','=','events.id')
            ->where('subevents.id','=',$id)
            ->select('events.id AS eid','events.nome AS enome')->first();

        return view('sottoevento', ['sottoeventi' => $sottoevento, 'eventoPrincipale'=>$eventoPrincipale]);
    }

    public function favoriteSubevent (Request $request){
        $sottoevento = Subevent::all()->where('id',$request->id)->first();
        DB::table('subevents_selected')->insert([ "id_subevento" => $request->id, "id_utente" => Auth::user()->id ]);
        return view('calendario-eventi-preferiti');
    }
}
