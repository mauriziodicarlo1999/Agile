<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Topic;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreazioneTopicTest extends TestCase {

    use RefreshDatabase;

    public function test_carica_pagina() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/creazione-topic');
        $response->assertStatus(200);
    }

    public function test_nuovo_topic() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $response = $this->post('/creazione-topic', [
            "titolo" => 'titolo',
            "descrizione" => 'desc',
            "id_copertina" => 1,
            "id_creatore" => 1
        ]);
       // $response->assertStatus(200);
    }


}
