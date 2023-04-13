<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_evento', 30)->nullable();
            $table->string('nombre', 200)->nullable();
            $table->text('detalle')->nullable();
            $table->integer('qty_personas')->nullable();
            $table->integer('qty_asistencia')->nullable();
            $table->string('ubicacion', 250)->nullable();
            $table->dateTime('fecha_lanzamiento')->nullable();
            $table->string('estado', 60)->nullable();
            $table->boolean('es_activo')->default(true);
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
        Schema::dropIfExists('event');
    }
}
