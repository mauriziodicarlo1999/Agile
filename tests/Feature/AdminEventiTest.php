<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEventiTest extends TestCase {

    use RefreshDatabase;

    public function test_carica_pagina() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/admin/events');
        $response->assertStatus(200);
    }

    public function test_visualizza_lista_eventi() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $event = Event::factory()->create();

        $response = $this->get('/admin/events');
        $response->assertStatus(200);
    }

    public function test_elimina_evento() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $event = Event::factory()->create();

        $response = $this->post('/amdin/events', [
            "action" => "delete",
            "evento" => $event->id,
        ]);
    }
}
