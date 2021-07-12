<?php

namespace Tests\Feature;

use App\Models\Subevent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubeventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_visualizza_pagina_sottoevento() {
        $subevent = Subevent::factory()->create();
        $response = $this->get('/sottoevento-'.$subevent->id);
        $response->assertStatus(200);
    }

    public function test_add_preferiti () {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $subevent = Subevent::factory()->create();
        $response = $this->post('/sottoevento-'.$subevent->id, [
            "action" => "insert",
        ]);
    }

    public function test_delete_preferiti () {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $subevent = Subevent::factory()->create();
        $response = $this->post('/sottoevento-'.$subevent->id, [
            "action" => "delete",
        ]);
    }

}
