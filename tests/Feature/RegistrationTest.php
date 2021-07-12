<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'nome' => 'Test User',
            'cognome' => 'Test User',
            'email' => 'test@example.com',
            'nascita' => now(),
            'telefono' => '3401234567',
            'citta' => 'esempio',
            'indirizzo' => 'via di esempio',
            'civico' => 2,
            'password' => 'password',
            'confPassword' => 'password',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

}
