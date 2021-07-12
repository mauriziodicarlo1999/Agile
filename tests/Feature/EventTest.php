<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_visualizza_pagina_evento()
    {
        $event = Event::factory()->create();
        $response = $this->get('/evento-'.$event->id);
        $response->assertStatus(200);
    }
}
