<?php

namespace Tests\Feature;

use App\Models\Subevent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarioEventiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_vista_calendario_eventi()
    {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/calendario-eventi');
        $response->assertStatus(200);
    }
}
