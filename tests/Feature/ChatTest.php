<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_carica_lista() {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/lista-utenti');
        $response->assertStatus(200);
    }

    public function test_cerca_utente() {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->post('lista-utenti', [
            "search" => "test@email.it",
        ]);
        $response->assertStatus(200);
    }

    public function test_carica_chat() {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $user = User::factory()->create();
        $response = $this->get('/chat-utente-'.$user->id);
        $response->assertStatus(200);
    }

    public function test_invio_messaggio() {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $user = User::factory()->create();
        $response = $this->post('/chat-utente-'.$user->id, [
            "testo" => "esempio di testo",
        ]);
        $response->assertStatus(200);
    }
}
