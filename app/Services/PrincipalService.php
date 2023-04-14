<?php

namespace App\Services;

use App\Models\Principal;
use App\Models\Asistencia;
use App\Models\Guest;
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
            $titular->acompanantes = $this->getGuestByEvent($event_id, $titular->id);
        }

        return $titulares;
    }
    
    public function updateTitular(array $data, int $titular_id){

        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $correo = $data['correo'];
        $telefono = $data['telefono'];

        $titular = DB::select('CALL actualizarPrincipal (?,?,?,?,?)', array("$nombre", "$apellidos", "$correo", "$telefono", $titular_id));

        if(is_null($titular)) throw new Exception("Error al Actualizar Titular", 500);

        return $titular;
    }

    public function deleteTitular($event_id, $titular_id){
        $asistencia = Asistencia::where([
            ['evento_id', '=', $event_id],
            ['titular_id','=', $titular_id]
        ]);

        if($asistencia->count() <= 0) throw new Exception("No existe la Asistencia que intenta eliminar", 400);

        $asistencia = $asistencia->get();

        foreach($asistencia as $guest){
            $asiste = Asistencia::find($guest->id);
            $asiste->update(['es_activo'=> 0]);
        }

        return true;
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

    private function getGuestByEvent(int $event_id, int $principal_id){
        $guests = DB::table('asistencia as a')
        ->select(
            "g.id", 
            "g.nombre", 
            "g.apellidos", 
            DB::raw("CONCAT(g.nombre,' ',g.apellidos) as nombre_completo"), 
            "g.correo", 
            "g.telefono", 
            "a.id as asistencia_id"
        )        
        ->join("guest as g", "g.id","=", "a.acompanante_id")
        ->where('a.evento_id', $event_id)
        ->where('a.titular_id', $principal_id)
        ->where('a.es_activo', true)
        ->where('g.es_activo', true)
        ->where('a.acompanante_id','<>',NULL)
        ->get();
        
        return $guests;
    }
}