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
                    e.id,
                    e.codigo_evento, 
                    e.nombre, 
                    e.detalle, 
                    e.ubicacion, 
                    e.fecha_lanzamiento, 
                    e.estado,
                    (
                        SELECT 
                            count(a.id)
                        FROM asistencia as a
                        WHERE a.evento_id = e.id
                        AND es_activo = true
                    ) as asistentes
                FROM event as e
                WHERE e.es_activo = true
                ORDER BY e.fecha_lanzamiento desc;
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
