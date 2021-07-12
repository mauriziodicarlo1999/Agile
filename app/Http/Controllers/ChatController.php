<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller {

    public function viewList() {
        $myid = Auth::user()->id;
        $messages = DB::table('chats')->where('id_mittente', $myid)->orWhere('id_destinatario', $myid)->orderByDesc('created_at')->get();
        $usersid = array();
        foreach ($messages as $message) {
            if ($message->id_mittente == $myid) {
                if (!in_array($message->id_destinatario, $usersid))
                    $usersid[] = $message->id_destinatario;
            }else{
                if (!in_array($message->id_mittente, $usersid))
                    $usersid[] = $message->id_mittente;
            }
        }
        $users = array();
        foreach ($usersid as $item) {
            $users[] = User::all()->where('id', $item)->first();
        }
        return view('lista-utenti', ['users' => $users]);
    }

    public function viewChat($id) {
        if (Auth::user()->id == $id) return $this->viewList();
        $user = User::all()->where('id',$id)->first();
        if ($user == null) return $this->viewList();

        $messages = DB::table('chats')->where('id_mittente', Auth::user()->id)->where('id_destinatario', $id)
            ->orWhere('id_mittente', $id)->where('id_destinatario', Auth::user()->id)->orderBy('created_at')->get();

        return view('chat-utente', ['messages' => $messages, 'user' => $user, 'id' => $id]);
    }

    public function cercaUtente(Request $request) {
        $user = User::all()->where('email', $request->search)->where('categoria', '!=', 'not_user')->first();
        if ($user == null)
            return $this->viewChat(0);
        else
            return $this->viewChat($user->id);
    }

    public function invioMessaggio(Request $request, $id) {
        DB::table('chats')->insert([
            "id_mittente" => Auth::user()->id,
            "id_destinatario" => $id,
            "messaggio" => $request->testo,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        return $this->viewChat($id);
    }

}
