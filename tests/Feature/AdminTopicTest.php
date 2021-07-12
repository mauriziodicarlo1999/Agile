<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Topic;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTopicTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_visualizza_pagina_topic()
    {
        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $topic = Topic::factory()->create();
        $response = $this->get('/admin/topic-'.$topic->id);
        $response->assertStatus(200);
    }
    public function test_elimina_topic() {

        // Autenticazione
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();

        $topic = Topic::factory()->create();

        $response = $this->post('/admin/topic'.$topic->id, [
            "action" => "delete",
            "topic" => $topic->id
        ]);
    }
}
