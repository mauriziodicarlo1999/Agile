<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Artist extends Model {

    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'nome',
        'cognome',
        'nome_arte',
        'data_di_nascita',
        'luogo_di_nascita',
        'biografia',
        'id_copertina'
    ];

    public function events() {
        return $this->belongsToMany(Event::class, 'artist_event', 'id_artista', 'id_evento');
    }

    public function kinds() {
        return $this->belongsToMany(Kind::class, 'artist_kind', 'id_artista', 'id_genere');
    }

}
