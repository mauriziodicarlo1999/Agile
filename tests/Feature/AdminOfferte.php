<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminOfferte extends TestCase
{
    use RefreshDatabase;

    public function test_carica_pagina_offerta() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/admin/pricing');
        $response->assertStatus(200);
    }

    public function test_carica_pagina_nuova_offerta() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/admin/aggiungi-princing');
        $response->assertStatus(200);
    }

    public function test_carica_modifica_offerta() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/admin/modifica-pricing-1');
        $response->assertStatus(200);
    }

    public function test_crea_offerta() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/admin/aggiungi-pricing', [
            "titolo" => "titolo",
            "scadenza" => now(),
            "sconto" => 20,
            "id_evento" => 1
        ]);

        $response->assertStatus(200);
    }

    public function test_elimina_offerta() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/admin/pricing', [
            "id" => 1,
        ]);

        $response->assertStatus(200);
    }

    public function test_modifica_offerta() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/admin/modifica-pricing-1', [
            "titolo" => "titolo",
            "scadenza" => now(),
            "sconto" => 20,
            "id_evento" => 1
        ]);

        $response->assertStatus(200);
    }


}
