<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'cognome',
        'email',
        'data_di_nascita',
        'telefono',
        'citta',
        'indirizzo',
        'civico',
        'categoria',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subevents() {
        return $this->belongsToMany(Subevent::class, 'subevents_selected', 'id_utente','id_subevento');
    }

    // Da vedere come si usa crea il metodo per le relazioni ricorsive, ma non è fondamentale, probabile che non ci servirà
    /*public function chats() {
        return $this->belongsToMany(Subevent::class, 'subevents_selected', 'id_utente','id_subevento');
    }*/

    public function organizedEvents() {
        return $this->hasMany(Event::class, 'id_organizzatore');
    }

    public function inscriptions() {
        return $this->belongsToMany(Event::class, 'inscriptions', 'id_utente','id_evento');
    }

    public function createdTopics() {
        return $this->hasMany(Topic::class, 'id_creatore');
    }

}
