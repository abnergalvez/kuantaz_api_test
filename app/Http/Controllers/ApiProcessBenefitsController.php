<?php

namespace App\Http\Controllers;

use App\Contracts\ProcessedBenefitsServiceContract;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Benefits, Filters & Profiles API",
 *     version="1.0"
 * )
 */
class ApiProcessBenefitsController extends Controller
{
    protected $processedBenefits;

    public function __construct(ProcessedBenefitsServiceContract $processedBenefits)
    {
        $this->processedBenefits = $processedBenefits;
    }

    /**
     * Display a listing of the processed benefits.
     *
     * @OA\Get(
     *     path="/api/process_benefits",
     *     summary="Get all processed benefits",
     *     tags={"Processed Benefits"},
     *     @OA\Response(
     *         response=200,
     *         description="List of processed benefits",
     *         @OA\JsonContent(type="array", @OA\Items(ref=""))
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
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
                'code' => 500,
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Display a listing of the benefits processed By Year.
     *
     * @OA\Get(
     *     path="/api/process_benefits/year/{year}",
     *     summary="Get processed benefits filtered by year",
     *     tags={"Processed Benefits By Year"},
     *     @OA\Parameter(
     *         name="year",
     *         in="path",
     *         required=true,
     *         description="Year to filter processed benefits",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of processed benefits by year",
     *         @OA\JsonContent(type="array", @OA\Items(ref=""))
     *     ),
     *     @OA\Response(response=400, description="Invalid year provided"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
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
