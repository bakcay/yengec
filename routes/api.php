<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IntegrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
   Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
});



Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/integration',  [IntegrationController::class, 'store'])->name('api.integration.store');
    Route::put('/integration/{id}', [IntegrationController::class, 'update'])->name('api.integration.update');
    Route::delete('/integration/{id}', [IntegrationController::class, 'destroy'])->name('api.integration.destroy');
});
