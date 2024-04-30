<?php

namespace App\Http\Controllers;

use App\Contracts\ProcessedBenefitsServiceContract;
use Illuminate\Http\Request;

class ApiProcessBenefitsController extends Controller
{
    protected $processedBenefits;

    public function __construct(ProcessedBenefitsServiceContract $processedBenefits)
    {
        $this->processedBenefits = $processedBenefits;
    }

    public function index() : \Illuminate\Http\JsonResponse
    {
        try {
            $processedBenefits = $this->processedBenefits->getProcessedBenefits();
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $processedBenefits->toArray()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'success' => false,
                'message' => $th->getMessage()
            ], $th->getCode());
        }
    }

    public function getByYear(Request $request):  \Illuminate\Http\JsonResponse
    {
        try {

            if (!is_numeric($request->year)) {
                throw new \InvalidArgumentException('El año debe ser un valor numérico entero');
            }
            $processedBenefits = $this->processedBenefits->getProcessedBenefitsByYear($request->year);
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $processedBenefits->toArray()
            ]);

        } catch (\InvalidArgumentException $ex) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'Dato de Año inválido'
            ], 400);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
