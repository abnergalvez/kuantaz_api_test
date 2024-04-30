<?php

namespace App\Http\Controllers;

use App\Contracts\BenefitsServiceContract;


class ApiBenefitsController extends Controller
{
    protected $benefitsService;

    public function __construct(BenefitsServiceContract $benefitsService)
    {
        $this->benefitsService = $benefitsService;
    }

    /**
     * Display a original list of benefits.
     *
     * @OA\Get(
     *     path="/api/benefits",
     *     summary="Get all original benefits (only benefits)",
     *     tags={"Original Benefits"},
     *     @OA\Response(
     *         response=200,
     *         description="List of original benefits",
     *         @OA\JsonContent(type="array", @OA\Items(ref=""))
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        try {
            $fullBenefits = $this->benefitsService->getBenefits();
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $fullBenefits
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
