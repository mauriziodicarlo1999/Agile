<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfiloTest extends TestCase {

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

    public function test_modifica_dati_utente () {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/profilo', [
            "azione" => "modificaProfilo",
            "telefono" => '1234',
            "civico" => 1,
            "citta" => 'ese',
            "indirizzo" => 'ese',
        ]);

        $response->assertStatus(200);
    }

    public function test_modifica_pwd () {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/profilo', [
            "passwordNuova" => 12345678,
            "confermaPassword" => 12345678,
        ]);

        $response->assertStatus(200);
    }

}
