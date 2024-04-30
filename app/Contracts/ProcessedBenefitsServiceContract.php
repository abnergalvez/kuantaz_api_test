<?php

namespace App\Contracts;

interface ProcessedBenefitsServiceContract
{
    public function getProcessedBenefits();

    public function getProcessedBenefitsByYear(int $year);
}
