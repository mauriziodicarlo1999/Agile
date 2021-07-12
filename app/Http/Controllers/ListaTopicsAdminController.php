<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListaTopicsAdminController extends Controller
{
    public function listaTopics(){
        $topics = Topic::all();
        return view ('admin.topics', ['topics' => $topics]);
    }

    public function singoloTopic($id){
        $topic = Topic::all()->where('id', $id)->first();
        return view ('admin.topic', ['topic' => $topic]);
    }

    public function elimina(Request $request){
        DB::table('topics')->where('id', $request->id)->delete();
        return $this->listaTopics();
    }

}
