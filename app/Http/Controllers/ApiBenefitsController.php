<?php

namespace App\Http\Controllers;

use App\Contracts\ProcessedBenefitsServiceContract;

class ApiBenefitsController extends Controller
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
            $benefitsOrdenados = $processedBenefits->sortByDesc('fecha');
            $benefitsByAnio = $benefitsOrdenados->groupBy(function ($benefit) {
                return substr($benefit['fecha'], 0, 4);
            });

            $result = $benefitsByAnio->map(function ($benefits, $year) {
                $totalAmount = $benefits->sum('monto');
                $benefitsCount = $benefits->count();
                return [
                    'year' => $year,
                    'total_amount' => $totalAmount,
                    'num' => $benefitsCount,
                    'beneficios' => $benefits->toArray()
                ];
            });

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $result->values()->toArray()
            ]);
        } catch (\Throwable $th) {
            // TODO: handle exception
        }
    }
}
