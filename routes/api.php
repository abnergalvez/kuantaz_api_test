<?php
use App\Http\Controllers\ApiBenefitsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/beneficios', [ApiBenefitsController::class, 'index'])->name('benefitsApi');
