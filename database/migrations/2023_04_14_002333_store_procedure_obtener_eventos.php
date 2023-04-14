<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProcedureObtenerEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `obtenerEventos`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `obtenerEventos`;
            CREATE PROCEDURE `obtenerEventos`()
            BEGIN
                SELECT 
                    id,
                    codigo_evento, 
                    nombre, 
                    detalle, 
                    ubicacion, 
                    fecha_lanzamiento, 
                    estado
                FROM event
                WHERE es_activo = true
                ORDER BY fecha_lanzamiento desc;
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
        $procedure = "DROP PROCEDURE IF EXISTS `obtenerEventos`;";
        DB::unprepared($procedure);
    }
}
