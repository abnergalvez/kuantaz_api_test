<?php

namespace App\Services;

use App\Contracts\ProcessedBenefitsServiceContract;
use App\Contracts\BenefitsServiceContract;
use App\Contracts\FiltersServiceContract;
use App\Contracts\ProfilesServiceContract;
use Illuminate\Support\Collection;

class ProcessedBenefitsService implements ProcessedBenefitsServiceContract
{
    protected $benefitsService;
    protected $filtersService;
    protected $profilesService;

    public function __construct(
        BenefitsServiceContract $benefitsService,
        FiltersServiceContract $filtersService,
        ProfilesServiceContract $profilesService
    ) {
        $this->benefitsService = $benefitsService;
        $this->filtersService = $filtersService;
        $this->profilesService = $profilesService;
    }

    public function getProcessedBenefits(): Collection
    {
        $benefits = collect($this->benefitsService->getBenefits());
        $filters = collect($this->filtersService->getFilters());
        $profiles = collect($this->profilesService->getProfiles());

        return $processedBenefits = $benefits->map(function ($benefit) use ($filters, $profiles) {
            $filter = $filters->firstWhere('id_programa', $benefit['id_programa']);
            $profile = $profiles->firstWhere('id', $filter['ficha_id']);
            $benefit['view'] = true;
            $benefit['ano'] = substr($benefit['fecha'], 0, 4);
            $benefit['ficha'] = $profile;
            $min = $filter['min'];
            $max = $filter['max'];
            $monto = $benefit['monto'];
            if ($monto >= $min && $monto <= $max) {
                return $benefit;
            } else {
                return null;
            }
        })->filter();

    }
}
