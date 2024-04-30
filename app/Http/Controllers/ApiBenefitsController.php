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
