<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kind extends Model {

    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'nome',
    ];

    public function artists() {
        return $this->belongsToMany(Artist::class, 'artist_kind', 'id_genere','id_artista');
    }

}
