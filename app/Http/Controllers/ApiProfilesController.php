<?php

namespace App\Http\Controllers;

use App\Contracts\ProfilesServiceContract;

class ApiProfilesController extends Controller
{
    protected $profilesService;

    public function __construct(ProfilesServiceContract $profilesService)
    {
        $this->profilesService = $profilesService;
    }

    /**
     * Display a original list of Profiles.
     *
     * @OA\Get(
     *     path="/api/profiles",
     *     summary="Get all original profiles (only profiles)",
     *     tags={"Original Profiles"},
     *     @OA\Response(
     *         response=200,
     *         description="List of original profiles",
     *         @OA\JsonContent(type="array", @OA\Items(ref=""))
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        try {
            $fullProfiles = $this->profilesService->getProfiles();
            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $fullProfiles
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
