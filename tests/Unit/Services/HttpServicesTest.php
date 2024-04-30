<?php

namespace Tests\Unit\Services;

use App\Services\HttpBenefitsService;
use App\Services\HttpFiltersService;
use App\Services\HttpProfilesService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class HttpServicesTest extends TestCase
{
    public function testGetHttpServiceBenefits()
    {
        $data = [
            [
                "id_programa" => 147,
                "monto" => 40656,
                "fecha_recepcion" => "09/11/2023",
                "fecha" => "2023-11-09",
            ],
            [
                "id_programa" => 147,
                "monto" => 60000,
                "fecha_recepcion" => "10/10/2023",
                "fecha" => "2023-10-10",
            ],
            [
                "id_programa" => 130,
                "monto" => 40656,
                "fecha_recepcion" => "08/09/2023",
                "fecha" => "2023-09-08",
            ]
        ];
        Http::fake([
            'https://run.mocky.io/v3/399b4ce1-5f6e-4983-a9e8-e3fa39e1ea71' => Http::response(['data' => $data], 200),
        ]);

        $service = new HttpBenefitsService();
        $benefits = $service->getBenefits();

        $this->assertEquals($data, $benefits);
    }

    public function testGetHttpServiceFilters()
    {
        $data = [
            [
                "id_programa" => 147,
                "tramite" => "Emprende",
                "min" => 0,
                "max" => 50000,
                "ficha_id" => 922
            ],
            [
                "id_programa" => 146,
                "tramite" => "Crece",
                "min" => 0,
                "max" => 30000,
                "ficha_id" => 903
            ],
            [
                "id_programa" => 130,
                "tramite" => "Subsidio Único Familiar",
                "min" => 5000,
                "max" => 180000,
                "ficha_id" => 2042
            ]
        ];

        Http::fake([
            'https://run.mocky.io/v3/06b8dd68-7d6d-4857-85ff-b58e204acbf4' => Http::response(['data' => $data], 200),
        ]);

        $service = new HttpFiltersService();
        $filters = $service->getFilters();

        $this->assertEquals($data, $filters);
    }

    public function testGetHttpServiceProfiles()
    {
        $data = [
            [
                "id" => 903,
                "nombre" => "Crece",
                "id_programa" => 146,
                "url" => "crece",
                "categoria" => "trabajo",
                "descripcion" => "Subsidio para implementar plan de trabajo en empresas"
            ],
            [
                "id" => 922,
                "nombre" => "Emprende",
                "id_programa" => 147,
                "url" => "emprende",
                "categoria" => "trabajo",
                "descripcion" => "Fondos concursables para nuevos negocios"
            ],
            [
                "id" => 2042,
                "nombre" => "Subsidio Familiar (SUF)",
                "id_programa" => 130,
                "url" => "subsidio_familiar_suf",
                "categoria" => "bonos",
                "descripcion" => "Beneficio económico mensual entregado a madres, padres o tutores que no cuentan con previsión social."
            ]
        ];

        Http::fake([
            'https://run.mocky.io/v3/c7a4777f-e383-4122-8a89-70f29a6830c0' => Http::response(['data' => $data], 200),
        ]);

        $service = new HttpProfilesService();

        $profiles = $service->getProfiles();
        $this->assertEquals($data, $profiles);
    }

}
