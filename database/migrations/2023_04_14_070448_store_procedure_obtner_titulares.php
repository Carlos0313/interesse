<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProcedureObtnerTitulares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `obtenerTitulares`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `obtenerTitulares`;
            CREATE PROCEDURE `obtenerTitulares`(
                in event_id integer
            )
            BEGIN
                    SELECT  
                        p.id,
                        p.nombre,
                        p.apellidos,
                        concat(p.nombre,' ',p.apellidos) as nombre_completo,
                        p.correo,
                        p.telefono,
                        p.qty_acompanantes
                    FROM asistencia as a
                    JOIN principal as p on a.titular_id = p.id
                    WHERE a.evento_id = event_id
                    AND p.es_activo = true
                    ORDER BY p.nombre ASC; 
                    
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
        $procedure = "DROP PROCEDURE IF EXISTS `obtenerTitulares`;";
        DB::unprepared($procedure);
    }
}
