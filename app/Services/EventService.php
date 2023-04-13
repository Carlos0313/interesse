<?php

namespace App\Services;

use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\DB;

class EventService
{
    public function getProducts($data){

        $productos = Event::where('activo',1)
        ->Nombre($data['nombre'])
        ->SKU($data['sku'])
        ->Rango($data['rango']['min'], $data['rango']['max'])
        ->orderBy('nombre', 'ASC')
        ->get();
        
        return $productos;
    }

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

    public function updateProduct(array $data){
        $producto = Event::find($data['product_id']);

        if(is_null($producto)) throw new Exception("No existe el Producto que intenta actualizar", 400);
        if($producto->activo != 1) throw new Exception("Este Producto ya ha sido removido de la lista", 400);


        $sku = $this->generateCode($data['nombre']);
        $data['sku'] = $sku;

        $producto->fill($data);
        $producto->save();

        if(is_null($producto)) throw new Exception("Error al Actualizar Producto", 500);

        return $producto;
    }

    public function deleteProduct(int $product_id){
        $producto = Event::find($product_id);

        if(is_null($producto)) throw new Exception("No existe el Producto que intenta eliminar", 400);
        if($producto->activo != 1) throw new Exception("Este Producto ya ha sido removido de la lista", 400);

        $producto->update(['activo'=> 0]);

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