<?php

namespace App\Http\Controllers;

use Throwable;
use Exception;
use Carbon\Carbon;
use App\Services\GuestService;
use App\Http\Requests\NewGuestRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
class GuestController extends Controller
{
    protected GuestService $GuestService;

    public function __construct(GuestService $guestService)
    {
        $this->GuestService = $guestService;
    }

    public function createGuest(NewGuestRequest $request):JsonResponse
    {
        try{
            DB::beginTransaction();
                $guest = $this->GuestService->createGuest($request->all());
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            $code = $e->getCode() == 0 ? 500 : $e->getCode();

            if($code >= 500){
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ], $code);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage()
                ], $code);
            }
        }
        
        return response()->json([
            "res" => true,
            "guest" => $guest
        ], 201);
    }

    public function updateGuest(Request $request, $guest_id):JsonResponse
    {
        try{
            DB::beginTransaction();
                $guest = $this->GuestService->updateGuest($request->all(), $guest_id);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            $code = $e->getCode() == 0 ? 500 : $e->getCode();

            if($code >= 500){
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ], $code);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage()
                ], $code);
            }
        }
        
        return response()->json([
            "res" => true,
            "guest" => $guest
        ], 201);
    }

    public function deleteGuest($asistencia_id):JsonResponse
    {
        try{
            DB::beginTransaction();
                
                $this->GuestService->deleteGuest($asistencia_id);
            
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            $code = $e->getCode() == 0 ? 500 : $e->getCode();

            if($code >= 500){
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ], $code);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage()
                ], $code);
            }
        }

        return response()->json([
            "res" => true,
            "message" => "Acompañante Eliminado Correctamente"
        ], 200);
    }

    public function importGuest(Request $request):JsonResponse
    {
        try{
            DB::beginTransaction();
                $importedData = [];
                if($request->hasFile('file')){
                    $path = $request->file('file')->getRealPath();
                    $datos = Excel::toCollection(collect([]), $path);
                }

                if(!empty($datos) && $datos->count()){
                    foreach($datos[0] as $key => $data){
                        if($key == 0 )continue;
                        $importedData [] = [
                            "nombre" => $data[0],
                            "apellidos" => $data[1],
                            "correo" => $data[2],
                            "telefono" => $data[3],
                            "evento_id" => (int)$request->event_id,
                            "titular_id" => (int)$request->titular_id
                        ];
                    }
                }

                $this->GuestService->importGuest($importedData);
            
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            $code = $e->getCode() == 0 ? 500 : $e->getCode();

            if($code >= 500){
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ], $code);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => $e->getMessage()
                ], $code);
            }
        }

        return response()->json([
            "res" => true,
            "message" => "Archivo Cargado Correctamente"
        ], 201);
    }
}
