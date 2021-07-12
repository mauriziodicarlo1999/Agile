<?php


namespace App\Http\Controllers;


use App\Models\Subevent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SubeventController extends Controller
{
    public function getSubevent($id) {
        $sottoevento = Subevent::all()->where('id',$id)->first();
        $eventoPrincipale = DB::table('subevents')->join('events','subevents.id_evento','=','events.id')
            ->where('subevents.id','=',$id)
            ->select('events.id AS eid','events.nome AS enome')->first();
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento = DB::table('events')->limit(3)->get();

        return view('sottoevento', ['sottoevento' => $sottoevento,'eventoPrincipale'=>$eventoPrincipale,'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento' => $evento]);
    }

    public function editPreferiti(Request $request, $id) {
        $idUtente = Auth::user()->id;
        if ($request->action == "insert") {
            if (DB::table('subevents_selected')->where('id_subevento', $id)->where('id_utente', $idUtente)->count() == 0)
                DB::table('subevents_selected')->insert(["id_subevento" => $id, "id_utente" => $idUtente]);
        }else{
                DB::table('subevents_selected')->where('id_subevento', $id)->where('id_utente', $idUtente)->delete();
        }
        return $this->getSubevent($id);
    }

    public function favoriteSubevent (Request $request){
        $sottoevento = Subevent::all()->where('id',$request->id)->first();
        DB::table('subevents_selected')->insert([ "id_subevento" => $request->id, "id_utente" => Auth::user()->id ]);
        return view('eventi-preferiti');
    }

}
