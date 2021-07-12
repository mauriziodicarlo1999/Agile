<?php

namespace Tests\Feature;

use App\Models\Subevent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarioSottoeventiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sottoeventi_preferiti()
    {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/calendario-eventi-preferiti');
        $response->assertStatus(200);
    }
}

