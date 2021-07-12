<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    use HasFactory;

    protected $fillable = [
        'path'
    ];

    public function artists() {
        return $this->hasMany(Artist::class, 'id_copertina');
    }

    public function events() {
        return $this->hasMany(Event::class, 'id_copertina');
    }

    public function topics() {
        return $this->hasMany(Topic::class, 'id_copertina');
    }

}
