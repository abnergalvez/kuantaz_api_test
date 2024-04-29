<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Contracts\BenefitsServiceContract;
use App\Contracts\FiltersServiceContract;
use App\Contracts\ProfilesServiceContract;

class ApiBenefitsController extends Controller
{

    protected $benefitsService;
    protected $filtersService;
    protected $profilesService;

    public function __construct(
        BenefitsServiceContract $benefitsService ,
        FiltersServiceContract $filtersService,
        ProfilesServiceContract $profilesService,
        )
    {
        $this->benefitsService = $benefitsService;
        $this->filtersService = $filtersService;
        $this->profilesService = $profilesService;
    }
    public function index()
    {
        try {
            $benefits = collect($this->benefitsService->getBenefits());
            $filters = collect($this->filtersService->getFilters());
            $profiles = collect($this->profilesService->getProfiles());

            $processedBenefits = $benefits->map(function ($benefit) use ($filters, $profiles) {
                $filter = $filters->firstWhere('id_programa', $benefit['id_programa']);
                $profile = $profiles->firstWhere('id', $filter['ficha_id']);
                $benefit['filtro'] = $filter;
                $benefit['ficha'] = $profile;
                return $benefit;
            });

            $benefitsOrdenados = $processedBenefits->sortByDesc('fecha');
            $benefitsByAnio = $benefitsOrdenados->groupBy(function ($benefit) {
                return substr($benefit['fecha'], 0, 4);
            });

            $result = $benefitsByAnio->map(function ($benefits, $anio) {
                $totalAmount = $benefits->sum('monto');
                $benefitsCount = $benefits->count();
                return [
                    'anio' => $anio,
                    'monto_total' => $totalAmount,
                    'numero_beneficios' => $benefitsCount,
                    'beneficios' => $benefits->toArray()
                ];
            });

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $result->values()->toArray()
            ]);
        } catch (\Throwable $th) {
        }
    }
}
