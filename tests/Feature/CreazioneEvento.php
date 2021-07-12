<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreazioneEvento extends TestCase {

    use RefreshDatabase;


    public function test_carica_pagina() {
        $response = $this->get('/creazione-evento');
        $response->assertStatus(200);
    }

}
