<?php
namespace App\Http\Controllers;

use App\Models\Kind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaGeneriAdminController extends Controller{

    public function listaGeneri(){
        $kinds = DB::table('kinds')->get();
        return view ('admin.kinds', ['kinds' => $kinds]);
    }

    public function aggiungiGenere(Request $request){

        Kind::create([
            "nome" => $request->nome,
        ]);

        return $this->listaGeneri();
    }

    public function eliminaGenere(Request $request){
        DB::table('kinds')->where('id', $request->id)->delete();
        return $this->listaGeneri();
    }

}

?>
