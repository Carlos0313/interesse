<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProcedureAsociarTitularGuest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `asociarTitularGuest`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `asociarTitularGuest`;
            CREATE PROCEDURE `asociarTitularGuest`(
                in event_id integer,
                in titular_id integer,
                in guest_id integer
            )
            BEGIN
                INSERT INTO asistencia (evento_id, titular_id, acompanante_id) VALUES (event_id, titular_id, guest_id);
                SELECT id, nombre, apellidos, correo, telefono from guest where id = guest_id order by id DESC;
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
        $procedure = "DROP PROCEDURE IF EXISTS `asociarTitularGuest`;";
        DB::unprepared($procedure);
    }
}
