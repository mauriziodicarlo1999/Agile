<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Event;

use App\Models\Image;
use App\Models\Subevent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CalendarioEventiController extends Controller {

    public function visualizzazioneCalendarioEventi(){
        $eventi = DB::table('events')->get();
        $topics2 = DB::table('topics')->limit(3)->orderByDesc('created_at')->get();
        $topics3 = DB::table('comments')->limit(3)->orderByDesc('created_at')->get();
        $evento2 = DB::table('events')->limit(3)->get();
        return view('calendario-eventi', ['eventi' => $eventi,'varTopics2' => $topics2, 'varTopics3' => $topics3, 'evento2' => $evento2]);
    }
}
