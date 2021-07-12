<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subevents', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->dateTime('data_ora_inizio');
            $table->dateTime('data_ora_fine');
            $table->text('descrizione');
            $table->foreignId('id_evento')->references('id')->on('events');
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
        Schema::dropIfExists('subevents');
    }
}
