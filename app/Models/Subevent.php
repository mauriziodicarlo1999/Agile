<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subevent extends Model {

    use HasFactory;
    protected $fillable = [
        'titolo','data_ora_inizio','data_ora_fine','descrizione','id_evento'
    ];

    public function event() {
        return $this->belongsTo(Event::class, 'id_evento');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'subevents_selected', 'id_subevento','id_utente');
    }

}
