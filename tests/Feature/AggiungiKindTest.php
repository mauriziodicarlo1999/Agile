<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AggiungiKindTest extends TestCase {

    use RefreshDatabase;

    public function test_carica_pagina() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/admin/aggiungi-kinds');
        $response->assertStatus(200);
    }

   public function test_nuovo_genere() {

       // Autenticazione
       $user = User::factory()->create();
       $response = $this->post('/login', [
           'email' => $user->email,
           'password' => 'password',
       ]);
       $this->assertAuthenticated();

        $response = $this->post('/admin/aggiungi-kinds', [
            "nome" => 'nome',
        ]);
        $response->assertStatus(200);
    }
}
