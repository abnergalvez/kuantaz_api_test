<?php

namespace Tests\Unit;

use App\Services\HttpBenefitsService;
use Illuminate\Foundation\Testing\TestCase;

class HttpBenefitsServiceTest extends TestCase
{
    public function testGetBenefitsReturnExpectedResponse()
    {
        // Arrange
        $benefitsService = new HttpBenefitsService();

        // Act
        $benefits = $benefitsService->getBenefits();

        // Assert
        $this->assertIsArray($benefits);
    }
}
