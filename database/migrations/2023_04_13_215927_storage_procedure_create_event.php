<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StorageProcedureCreateEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `insertarEventos`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `insertarEventos`;
            CREATE PROCEDURE `insertarEventos`(
                in codigo VARCHAR(30),
                in nom VARCHAR(200),
                in det TEXT,
                in ubi VARCHAR(250),
                in fecha DATETIME,
                in est VARCHAR(60)
            )
            BEGIN
            
                INSERT INTO event (codigo_evento, nombre, detalle, ubicacion, fecha_lanzamiento, estado) VALUES (
                    codigo,
                    nom,
                    det,
                    ubi,
                    fecha,
                    est
                );
                
            END";

        DB::unprepared($procedure);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `insertarEventos`;";
        DB::unprepared($procedure);
    }
}
