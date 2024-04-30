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

    /**
     * Display a original list of Filters.
     *
     * @OA\Get(
     *     path="/api/filters",
     *     summary="Get all original filters (only filters)",
     *     tags={"Original Filters"},
     *     @OA\Response(
     *         response=200,
     *         description="List of original filters",
     *         @OA\JsonContent(type="array", @OA\Items(ref=""))
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
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
