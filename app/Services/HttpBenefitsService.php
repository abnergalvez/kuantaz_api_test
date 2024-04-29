<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Contracts\BenefitsServiceContract;

class HttpBenefitsService implements BenefitsServiceContract
{
    public function getBenefits()
    {
        $endpoint = "https://run.mocky.io/v3/399b4ce1-5f6e-4983-a9e8-e3fa39e1ea71";
        return Http::get($endpoint)->json()['data'];
    }
}
