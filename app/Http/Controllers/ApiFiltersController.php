<?php

namespace App\Http\Controllers;

use App\Contracts\FiltersServiceContract;

class ApiFiltersController extends Controller
{
    protected $filtersService;

    public function __construct(FiltersServiceContract $filtersService)
    {
        $this->filtersService = $filtersService;
    }


    public function index() : \Illuminate\Http\JsonResponse
    {
        try {
            $fullFilters = $this->filtersService->getFilters();
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $fullFilters
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
