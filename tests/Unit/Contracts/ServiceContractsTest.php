<?php

namespace Tests\Unit\Contracts;

use App\Contracts\BenefitsServiceContract;
use App\Contracts\FiltersServiceContract;
use App\Contracts\ProfilesServiceContract;
use App\Services\HttpBenefitsService;
use App\Services\HttpFiltersService;
use App\Services\HttpProfilesService;
use Tests\TestCase;

class ServiceContractsTest extends TestCase
{
    public function testBenefitsServiceImplementsContract()
    {
        $service = new HttpBenefitsService();
        $this->assertInstanceOf(BenefitsServiceContract::class, $service);
    }

    public function testFiltersServiceImplementsContract()
    {
        $service = new HttpFiltersService();
        $this->assertInstanceOf(FiltersServiceContract::class, $service);
    }

    public function testProfilesServiceImplementsContract()
    {
        $service = new HttpProfilesService();
        $this->assertInstanceOf(ProfilesServiceContract::class, $service);
    }
}
