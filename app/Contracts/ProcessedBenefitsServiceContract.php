<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ProcessedBenefitsServiceContract
{
    public function getProcessedBenefits(): Collection;
}
