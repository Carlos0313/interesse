<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id')->nullable();
            $table->unsignedBigInteger('titular_id')->nullable();
            $table->unsignedBigInteger('acompanante_id')->nullable();
            $table->boolean('asiste')->default(false);
            $table->timestamps();

            $table->foreign('evento_id')->references('id')->on('event');
            $table->foreign('titular_id')->references('id')->on('principal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencia');
    }
}
