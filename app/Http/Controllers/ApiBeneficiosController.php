<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Contracts\BeneficiosServiceContract;


class ApiBeneficiosController extends Controller
{

    protected $beneficiosService;

    public function __construct(BeneficiosServiceContract $beneficiosService)
    {
        $this->beneficiosService = $beneficiosService;
    }
    public function index()
    {
        try {
            $endpoint_filtros = "https://run.mocky.io/v3/06b8dd68-7d6d-4857-85ff-b58e204acbf4";
            $endpoint_fichas = "https://run.mocky.io/v3/c7a4777f-e383-4122-8a89-70f29a6830c0";

            $beneficios = collect($this->beneficiosService->getBeneficios());
            $filtros = collect(Http::get($endpoint_filtros)->json()['data']);
            $fichas = collect(Http::get($endpoint_fichas)->json()['data']);

            $beneficiosProcesados = $beneficios->map(function ($beneficio) use ($filtros, $fichas) {
                $filtro = $filtros->firstWhere('id_programa', $beneficio['id_programa']);
                $ficha = $fichas->firstWhere('id', $filtro['ficha_id']);
                $beneficio['filtro'] = $filtro;
                $beneficio['ficha'] = $ficha;
                return $beneficio;
            });

            $beneficiosOrdenados = $beneficiosProcesados->sortByDesc('fecha');
            $beneficiosPorAnio = $beneficiosOrdenados->groupBy(function ($beneficio) {
                return substr($beneficio['fecha'], 0, 4);
            });

            $resultados = $beneficiosPorAnio->map(function ($beneficios, $anio) {
                $montoTotal = $beneficios->sum('monto');
                $numeroBeneficios = $beneficios->count();
                return [
                    'anio' => $anio,
                    'monto_total' => $montoTotal,
                    'numero_beneficios' => $numeroBeneficios,
                    'beneficios' => $beneficios->toArray()
                ];
            });

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $resultados->values()->toArray()
            ]);
        } catch (\Throwable $th) {
        }
    }
}
