<?php
use App\Http\Controllers\ApiBeneficiosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/beneficios', [ApiBeneficiosController::class, 'index'])->name('api_beneficios');
