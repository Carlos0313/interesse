<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StorageProcedureCreateTitular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `insertarPrincipal`;";
        DB::unprepared($procedure);
        $procedure = "DROP PROCEDURE IF EXISTS `insertarPrincipal`;
            CREATE PROCEDURE `insertarPrincipal`(                
                in nom VARCHAR(80),
                in ape VARCHAR(100),
                in email VARCHAR(40),
                in phone VARCHAR(20)
            )
            BEGIN
                INSERT INTO principal (nombre, apellidos, correo, telefono) VALUES (nom,ape, email, phone);
                SELECT nombre, apellidos, correo, telefono from principal order by id DESC Limit 1;
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
        $procedure = "DROP PROCEDURE IF EXISTS `insertarPrincipal`;";
        DB::unprepared($procedure);
    }
}
