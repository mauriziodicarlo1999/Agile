<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    use HasFactory;

    protected $fillable = [
        'nome_mittente',
        'email_mittente',
        'testo',
        'id_topic',
    ];

    public function topic() {
        return $this->belongsTo(Topic::class, 'id_topic');
    }

}
