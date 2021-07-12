<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoricoEventiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_storico()
    {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/storico-eventi');
        $response->assertStatus(200);
    }
}
