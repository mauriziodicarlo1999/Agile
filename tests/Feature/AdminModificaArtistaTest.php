<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminModificaArtistaTest extends TestCase {

    use RefreshDatabase;

    public function test_carica_pagina() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $artista = Artist::factory()->create();
        $response = $this->get('/admin/modifica-artista-'.$artista->id);
        $response->assertStatus(200);
    }

    public function test_visualizza_lista_artisti() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $artista = Artist::factory()->create();
        $response = $this->get('/admin/modifica-artista-'.$artista->id);
        $response->assertStatus(200);
    }

    /*public function test_modifica_artista() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $event = Event::factory()->create();
        $image = Image::factory()->create();

        $response = $this->post('/amdin/events'.$event->id, [
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
            "id_copertina" => $image->id,
            "id_organizzatore" => $user->id
        ]);
    }*/
}
