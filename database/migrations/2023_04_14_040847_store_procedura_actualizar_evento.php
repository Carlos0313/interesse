<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProceduraActualizarEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarEvento`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarEvento`;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarEvento`(
                in codigo VARCHAR(30),
                in nom VARCHAR(200),
                in det TEXT,
                in ubi VARCHAR(250),
                in fecha DATETIME,
                in est VARCHAR(60),
                in evento_id int
            )
            BEGIN

                UPDATE event 
                SET codigo_evento=codigo
                ,nombre=nom
                ,detalle=det
                ,ubicacion=ubi
                ,fecha_lanzamiento = fecha
                ,estado = est
                WHERE id = evento_id;

                SELECT codigo_evento, nombre, detalle, ubicacion, fecha_lanzamiento, estado from event order by id DESC Limit 1;
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
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarEvento`;";
        DB::unprepared($procedure);
    }
}
