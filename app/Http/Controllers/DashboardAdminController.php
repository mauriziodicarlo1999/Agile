<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function vediTutto(){
        $artists = DB::table('artists')->get();
        $events = DB::table('events')->orderBy('data_ora_inizio')->get();
        $topics = DB::table('topics')->orderBy('created_at')->get();
        $inscriptions = DB::table('inscriptions')->get();
        $users = DB::table('users')->get();

        $eventsList = DB::table('events')->paginate(5);

        return view('admin.dashboard',['artists' => $artists, 'events' => $events, 'topics' => $topics, 'inscriptions' => $inscriptions, 'users' => $users, 'eventsList' => $eventsList ]);
    }
}
