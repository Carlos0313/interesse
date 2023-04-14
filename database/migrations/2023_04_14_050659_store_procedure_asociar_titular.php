<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProcedureAsociarTitular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `asociarTitular`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `asociarTitular`;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `asociarTitular`(
                in event_id integer,
                in titular_id integer
            )
            BEGIN
                INSERT INTO asistencia (evento_id, titular_id) VALUES (event_id, titular_id);
                SELECT id, nombre, apellidos, correo, telefono from principal where id = titular_id order by id DESC;
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
        $procedure = "DROP PROCEDURE IF EXISTS `asociarTitular`;";
        DB::unprepared($procedure);
    }
}
