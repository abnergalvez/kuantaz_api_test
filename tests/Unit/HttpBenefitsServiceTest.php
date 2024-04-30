<?php

namespace Tests\Unit;

use App\Services\HttpBenefitsService;
use Illuminate\Foundation\Testing\TestCase;

class HttpBenefitsServiceTest extends TestCase
{
    public function testGetBenefitsReturnExpectedResponse()
    {
        $benefitsService = new HttpBenefitsService();

        $benefits = $benefitsService->getBenefits();

        $this->assertIsArray($benefits);
    }
}
