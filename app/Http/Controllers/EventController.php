<?php

namespace App\Http\Controllers;

use Throwable;
use Exception;
use Carbon\Carbon;
use App\Services\EventService;
use App\Http\Requests\NewEventRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    protected EventService $EventService;

    public function __construct(EventService $eventService)
    {
        $this->EventService = $eventService;
    }

    public function getAllEvents(Request $request):JsonResponse
    {
        try{
            DB::beginTransaction();
                $eventos = $this->EventService->getAllEvents();
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
            "eventos" => $eventos
        ], 200);
    }

    public function createEvent(NewEventRequest $request):JsonResponse
    {
        try{
            DB::beginTransaction();
                $evento = $this->EventService->createEvent($request->all());
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
            "evento" => $evento
        ], 201);
    }

    public function updateEvent(Request $request, $evento_id):JsonResponse
    {
        try{
            DB::beginTransaction();
                $evento = $this->EventService->updateEvent($request->all(), $evento_id);
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
            "evento" => $evento
        ], 201);
    }

    public function deleteEvent($event_id):JsonResponse
    {
        try{
            DB::beginTransaction();
            
                $this->EventService->deleteEvent($event_id);
            
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
            "message" => "Evento Eliminado Correctamente"
        ], 200);
    }
}

