<?php

namespace App\Services;

use App\Models\Asistencia;
use App\Models\Guest;
use Exception;
use Illuminate\Support\Facades\DB;

class GuestService
{

    public function createGuest(array $data){

        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $correo = $data['correo'];
        $telefono = $data['telefono'];
        $evento_id = $data['evento_id'];
        $titular_id = $data['titular_id'];
        
        $exist = Guest::where('correo', $correo);

        if($exist->count() > 0){
            $guest = $exist->first();
            $this->associateEventTitular($evento_id, $titular_id, $guest->id);
        }else{
            $guest = DB::select('CALL insertarGuest (?,?,?,?)', array("$nombre", "$apellidos", "$correo", "$telefono"));
            
            if(is_null($guest)) throw new Exception("Error al Crear Acompañante", 500);

            $this->associateEventTitular($evento_id, $titular_id, $guest[0]->id);

            $guest = $guest[0];
        }
        
        return $guest;
    }
    
    public function updateGuest(array $data, int $guest_id){

        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $correo = $data['correo'];
        $telefono = $data['telefono'];

        $titular = DB::select('CALL actualizarGuest (?,?,?,?,?)', array("$nombre", "$apellidos", "$correo", "$telefono", $guest_id));

        if(is_null($titular)) throw new Exception("Error al Actualizar Titular", 500);

        return $titular;
    }

    public function deleteGuest($asistencia_id){
        $asistencia = Asistencia::where($asistencia_id);

        if($asistencia->count() <= 0) throw new Exception("No existe el Acompañante que intenta eliminar", 400);

        $asistencia->update(['es_activo'=> 0]);

        return true;
    }

    // Private function Zone
    private function associateEventTitular(int $event_id, int $principal_id, int $guest_id){
        $asistencia = Asistencia::where([
            ['evento_id','=',$event_id],
            ['titular_id','=',$principal_id],
            ['acompanante_id','=',$guest_id],
        ]);

        if($asistencia->count() > 0) throw new Exception("Lo sentimos, Ya ha sido Asociado a este Evento", 500);

        $asociacion = DB::select('CALL asociarTitularGuest (?,?,?)', array($event_id, $principal_id, $guest_id));

        return $asociacion;
    }

}