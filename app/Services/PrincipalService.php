<?php

namespace App\Services;

use App\Models\Principal;
use Exception;
use Illuminate\Support\Facades\DB;

class PrincipalService
{

    public function createTitular(array $data){

        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $correo = $data['correo'];
        $telefono = $data['telefono'];
        
        $exist = Principal::where('correo', $correo);
        if($exist->count() > 0) throw new Exception("Este Correo ya existe", 400);
        
        $titular = DB::select('CALL insertarPrincipal (?,?,?,?,?,?)', array("$nombre", "$apellidos", "$correo", "$telefono"));

        if(is_null($titular)) throw new Exception("Error al Crear Titular", 500);

        return $titular;
    }

    public function associateEvent(int $event_id, int $principal_id){
        
    }

}