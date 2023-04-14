<?php

namespace App\Services;

use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\DB;

class EventService
{

    public function createEvent(array $data){

        $code = $this->generateCode($data['nameEvent']);

        $codigo_evento = $code;
        $nombre = $data['nameEvent'];
        $detalle = $data['descriptionEvent'];
        $ubicacion = $data['ubication'];
        $fecha_lanzamiento = $data['date'];
        $estado = $data['state'];
         
        $evento = DB::select('CALL insertarEventos (?,?,?,?,?,?)', array("$codigo_evento", "$nombre", "$detalle", "$ubicacion", "$fecha_lanzamiento", "$estado"));

        if(is_null($evento)) throw new Exception("Error al Crear Evento", 500);

        return $evento;
    }

    public function deleteEvent($event_id){
        $evento = Event::find($event_id);

        if(is_null($evento)) throw new Exception("No existe el Evento que intenta eliminar", 400);
        if($evento->es_activo != 1) throw new Exception("Este Evento ya ha sido removido de la lista", 400);

        $evento->update(['es_activo'=> 0]);

        return true;
    }

    // Private Funtions
    private function generateCode($nombre){
        $prefijo = 'event-';
        $numero_aleatorio = $this->generarCodigo(3);
        $ultimas_letras = substr($nombre,-3);

        $sku = $prefijo.$numero_aleatorio.$ultimas_letras;

        return $sku;
    }

    function generarCodigo($longitud){
        $llave = '';
        $patron = '1234567890';
        $max = strlen($patron)-1;
        for($i=0;$i < $longitud;$i++){ 
            $llave .= $patron[mt_rand(0,$max)];
        }

        return $llave;
    }   

}