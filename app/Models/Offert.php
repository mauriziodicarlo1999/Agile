<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offert extends Model {

    protected $fillable = [
        'titolo',
        'scadenza',
        'sconto',
        'id_evento',
    ];

    public function event() {
        return $this->belongsTo(Event::class, 'id_evento');
    }

}
