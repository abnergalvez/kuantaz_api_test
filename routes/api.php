<?php
use App\Http\Controllers\ApiBenefitsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/benefits', [ApiBenefitsController::class, 'index']);
Route::get('/benefits/year/{year}', [ApiBenefitsController::class, 'getByYear']);
