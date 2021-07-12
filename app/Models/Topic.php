<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Topic extends Model {

    use HasFactory, Notifiable;

    protected $fillable = [
        'titolo',
        'descrizione',
        'id_creatore',
        'id_copertina',
    ];

    public function comments() {
        return $this->hasMany(Comment::class, 'id_topic');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'id_creatore');
    }

}
