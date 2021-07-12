<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descrizione');
            $table->string('citta');
            $table->string('indirizzo');
            $table->dateTime('data_ora_inizio');
            $table->dateTime('data_ora_fine');
            $table->enum('tipologia', ['Concerto', 'Musical', 'Spettacolo', 'Beneficienza', 'Sport', 'Fiera', 'Congresso']);
            $table->text('policy');
            $table->integer('max_iscritti');
            $table->boolean('tipologia_iscrizione');        // TRUE = interna al sito, FALSE = esterna al sito
            $table->decimal('prezzo');
            $table->boolean('stato');
            $table->foreignId('id_organizzatore')->references('id')->on('users');
            $table->foreignId('id_copertina')->references('id')->on('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
