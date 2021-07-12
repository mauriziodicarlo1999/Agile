<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreazioneEventoTest extends TestCase {

    use RefreshDatabase;

    public function test_carica_pagina() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/creazione-evento');
        $response->assertStatus(200);
    }

   public function test_nuovo_evento() {

       // Autenticazione
       $user = User::factory()->create();
       $response = $this->post('/login', [
           'email' => $user->email,
           'password' => 'password',
       ]);
       $this->assertAuthenticated();

        $response = $this->post('/creazione-evento', [
            "nome" => 'nome',
            "descrizione" => 'desc',
            "citta" => 'ese',
            "indirizzo" => 'ese',
            "data_ora_inizio" => now(),
            "data_ora_fine" => now(),
            "tipologia" => "Concerto",
            "max_iscritti" => 1,
            "policy" => "ok",
            "tipologia_iscrizione" => 0,
            "prezzo" => 10,
            "id_copertina" => 1,
            "id_organizzatore" => 1
        ]);

        $response->assertStatus(200);
    }


}
