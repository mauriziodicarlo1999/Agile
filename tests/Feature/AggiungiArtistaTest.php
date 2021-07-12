<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AggiungiArtistaTest extends TestCase {

    use RefreshDatabase;

    public function test_carica_pagina() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/admin/aggiungi-artista');
        $response->assertStatus(200);
    }

   public function test_nuovo_artista() {

       // Autenticazione
       $user = User::factory()->create();
       $response = $this->post('/login', [
           'email' => $user->email,
           'password' => 'password',
       ]);
       $this->assertAuthenticated();

        $response = $this->post('/admin/aggiungi-artista', [
            "nome" => 'nome',
            "cognome" => 'desc',
            "nomeArte" => 'ese',
            "biografia" => 'ese',
            "data_di_nascita" => now(),
            "luogo_di_nascita" => 'luogo',
            "genere" => 1,
        ]);
    }
}
