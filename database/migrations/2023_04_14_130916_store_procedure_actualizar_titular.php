<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoreProcedureActualizarTitular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarPrincipal`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarPrincipal`;
            CREATE PROCEDURE `actualizarPrincipal`(
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20),
                in titular_id int
            )
            BEGIN
                        UPDATE principal 
                        SET nombre =nom
                            ,apellidos=ape
                            ,correo=email
                            ,telefono = phone
                        WHERE id = titular_id;

                        SELECT id, nombre, apellidos, correo, telefono from principal  WHERE id = titular_id order by id DESC;
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
        $procedure = "DROP PROCEDURE IF EXISTS `actualizarPrincipal`;";
        DB::unprepared($procedure);
    }
}
