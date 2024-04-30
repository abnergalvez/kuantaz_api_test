<?php
use App\Http\Controllers\ApiBenefitsController;
use App\Http\Controllers\ApiFiltersController;
use App\Http\Controllers\ApiProcessBenefitsController;
use App\Http\Controllers\ApiProfilesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'process_benefits'], function () {
    Route::get('/', [ApiProcessBenefitsController::class, 'index']);
    Route::get('/year/{year}', [ApiProcessBenefitsController::class, 'getByYear']);
});

Route::get('/benefits', [ApiBenefitsController::class, 'index']);
Route::get('/filters', [ApiFiltersController::class, 'index']);
Route::get('/profiles', [ApiProfilesController::class, 'index']);
