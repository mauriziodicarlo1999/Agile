<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\Image;
use App\Models\Kind;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_visualizza_pagina_artista()
    {
        $artist = Artist::factory()->create();
        $kind = Kind::factory()->create();
        DB::table('artists_kind')->insert(['id_artista' => $artist->id, 'id_genere' => $kind->id]);
        $response = $this->get('/artista-'.$artist->id);
        //$response = $this->get('/artista',[\App\Http\Controllers\ArtistController::class, 'viewArtist',
        //    'id' => $artist->id]);

        $response->assertStatus(200);
    }
}
