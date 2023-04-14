<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProcedureInsertarGuest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `insertarGuest`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `insertarGuest`;
            CREATE PROCEDURE `insertarGuest`(
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20)
            )
            BEGIN
                    INSERT INTO guest (nombre, apellidos, correo, telefono) VALUES (nom,ape, email, phone);
                    SELECT id, nombre, apellidos, correo, telefono from principal order by id DESC Limit 1;
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
        $procedure = "DROP PROCEDURE IF EXISTS `insertarGuest`;";
        DB::unprepared($procedure);
    }
}
