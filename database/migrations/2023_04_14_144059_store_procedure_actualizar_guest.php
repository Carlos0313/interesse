<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProcedureActualizarGuest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarGuest`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarGuest`;
            CREATE PROCEDURE `actualizarGuest`(
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20),
                in guest_id int
            )
            BEGIN
                    UPDATE guest 
                    SET nombre =nom
                        ,apellidos=ape
                        ,correo=email
                        ,telefono = phone
                    WHERE id = guest_id;
            
                    SELECT id, nombre, apellidos, correo, telefono from guest  WHERE id = guest_id order by id DESC;
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
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarGuest`;";
        DB::unprepared($procedure);
    }
}
