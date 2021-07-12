<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model {

    use HasFactory, Notifiable;

    protected $fillable = [
        'nome',
        'descrizione',
        'citta',
        'indirizzo',
        'data_ora_inizio',
        'data_ora_fine',
        'tipologia',
        'policy',
        'max_iscritti',
        'tipologia_iscrizione',
        'prezzo',
        'stato',
        'id_organizzatore',
        'id_copertina',
    ];

    public function offerts() {
        return $this->hasMany(Offert::class, 'id_evento');
    }

    public function subevents() {
        return $this->hasMany(Subevent::class, 'id_evento');
    }

    public function organizer() {
        return $this->belongsTo(User::class, 'id_organizzatore');
    }

    public function image() {
        return $this->belongsTo(Image::class, 'id_copertina');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'inscriptions', 'id_evento','id_utente');
    }

    public function artists() {
        return $this->belongsToMany(Artist::class, 'artist_event', 'id_evento','id_artista');
    }

}
