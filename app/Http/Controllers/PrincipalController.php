<?php

namespace App\Http\Controllers;

use Throwable;
use Exception;
use Carbon\Carbon;
use App\Services\PrincipalService;
use App\Http\Requests\NewTitularRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrincipalController extends Controller
{
    protected PrincipalService $PrincipalService;

    public function __construct(PrincipalService $principalService)
    {
        $this->PrincipalService = $principalService;
    }

    public function createTitular(NewTitularRequest $request):JsonResponse
    {
        try{
            DB::beginTransaction();
                $titular = $this->PrincipalService->createTitular($request->all());
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
            "titular" => $titular
        ], 201);
    }

    public function getAllTitulares($event_id):JsonResponse
    {
        try{
            DB::beginTransaction();
                $titulares = $this->PrincipalService->getAllTitulares($event_id);
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
            "titulares" => $titulares
        ], 200);
    }

    public function updateTitular(Request $request, $titular_id):JsonResponse
    {
        try{
            DB::beginTransaction();
                $titular = $this->PrincipalService->updateTitular($request->all(), $titular_id);
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
            "titular" => $titular
        ], 201);
    }

    public function deleteTitular($event_id, $titular_id):JsonResponse
    {
        try{
            DB::beginTransaction();
            
                $this->PrincipalService->deleteTitular($event_id, $titular_id);
            
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
            "message" => "Titular Eliminado Correctamente"
        ], 200);
    }

}
