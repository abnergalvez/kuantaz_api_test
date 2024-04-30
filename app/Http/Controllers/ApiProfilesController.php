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
