<?php

namespace Tests\Feature;

use App\Models\Topic;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopicTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_viualizza_pagina_topic()
    {
        $topic = Topic::factory()->create();
        $response = $this->get('/topic-'.$topic->id);
        $response->assertStatus(200);
    }
}
