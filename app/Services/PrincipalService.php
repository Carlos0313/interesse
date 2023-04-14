<?php

namespace App\Services;

use App\Models\Principal;
use App\Models\Asistencia;
use Exception;
use Illuminate\Support\Facades\DB;

class PrincipalService
{

    public function createTitular(array $data){

        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $correo = $data['correo'];
        $telefono = $data['telefono'];
        $evento_id = $data['evento_id'];
        
        $exist = Principal::where('correo', $correo);
        if($exist->count() > 0){
            $titular = $exist->first();
            $this->associateEvent($evento_id, $titular->id);
        }else{
            $titular = DB::select('CALL insertarPrincipal (?,?,?,?)', array("$nombre", "$apellidos", "$correo", "$telefono"));
            
            if(is_null($titular)) throw new Exception("Error al Crear Titular", 500);

            $this->associateEvent($evento_id, $titular[0]->id);

            $titular = $titular[0];
        }
        
        return $titular;
    }

    public function getAllTitulares($event_id){
        $titulares = DB::select('CALL obtenerTitulares (?)', array($event_id));

        // Se Consultan los Acompañantes
        foreach($titulares as $titular){
            $titular->acompanantes = [];
        }

        return $titulares;
    }
    

    // Private function Zone
    private function associateEvent(int $event_id, int $principal_id){
        $asistencia = Asistencia::where([
            ['evento_id','=',$event_id],
            ['titular_id','=',$principal_id],
        ]);

        if($asistencia->count() > 0) throw new Exception("Lo sentimos, Ya ha sido Asociado a este Evento", 500);

        $asociacion = DB::select('CALL asociarTitular (?,?)', array("$event_id", "$principal_id"));

        return $asociacion;
    }

}