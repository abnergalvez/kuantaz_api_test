<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiProcessBenefitsControllerTest extends TestCase
{
    protected $responseProcessBenefitsData;

    public function setUp(): void
    {
        parent::setUp();
        $this->responseProcessBenefitsData = $this->get('/api/process_benefits');
    }

    public function testGetStatus200()
    {
        $response = $this->responseProcessBenefitsData;

        $response->assertStatus(200);
    }

    public function testGetCorrectStructure()
    {
        $response = $this->responseProcessBenefitsData;

        $response->assertJsonStructure([
            'code',
            'success',
            'data' => [
                '*' => [
                    'year',
                    'total_amount',
                    'num',
                    'beneficios' => [
                        '*' => [
                            'id_programa',
                            'monto',
                            'fecha_recepcion',
                            'fecha',
                            'ano',
                            'view',
                            'ficha' => [
                                'id',
                                'nombre',
                                'id_programa',
                                'url',
                                'categoria',
                                'descripcion',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function testGetCorrectYearOrderDesc()
    {
        $response = $this->responseProcessBenefitsData;
        $response->assertStatus(200);

        $data = $response->json('data');
        $years = collect($data)->pluck('year')->toArray();
        $sortedYears = $years;
        rsort($sortedYears);

        $this->assertEquals($years, $sortedYears);
    }

    public function testCorrectCountNumberByYear()
    {
        $response = $this->responseProcessBenefitsData;

        $response->assertStatus(200);

        $data = $response->json('data');
        foreach ($data as $yearData) {
            $numBenefits = $yearData['num'];
            $this->assertCount($numBenefits, $yearData['beneficios']);
        }
    }

    public function testCorrectTotalAmountByYear()
    {
        $response = $this->responseProcessBenefitsData;

        $response->assertStatus(200);

        $data = $response->json('data');
        foreach ($data as $yearData) {
            $montoSum = collect($yearData['beneficios'])->sum('monto');
            $this->assertEquals($montoSum, $yearData['total_amount']);
        }
    }

    public function testIfHasProfileData()
    {
        $response = $this->responseProcessBenefitsData;
        $response->assertStatus(200);
        $data = $response->json('data');
        foreach ($data as $yearData) {
            foreach ($yearData['beneficios'] as $beneficio) {
                $this->assertArrayHasKey('ficha', $beneficio);
            }
        }
    }

    public function testIfFilteredCorrectly()
    {
        $responseFilters = $this->get('/api/filters');
        $responseFilters->assertStatus(200);
        $filtros = $responseFilters->json('data');

        $response = $this->responseProcessBenefitsData;
        $response->assertStatus(200);
        $data = $response->json('data');

        foreach ($data as $yearData) {
            foreach ($yearData['beneficios'] as $beneficio) {
                $idPrograma = $beneficio['id_programa'];
                $filtro = collect($filtros)->firstWhere('id_programa', $idPrograma);
                $this->assertNotNull($filtro);
                $monto = $beneficio['monto'];
                $this->assertTrue($monto >= $filtro['min'] && $monto <= $filtro['max']);
            }
        }
    }

    public function testIfDatesCorrectInGetByYear_2023()
    {
        $year = 2023;
        $response = $this->get("/api/process_benefits/year/{$year}");
        $response->assertStatus(200);
        $data = $response->json('data');

        foreach ($data as $yearData) {
            $this->assertEquals($year, $yearData['year']);
            foreach ($yearData['beneficios'] as $beneficio) {
                $this->assertEquals($year, substr($beneficio['fecha'], 0, 4));
            }
        }
    }

}
