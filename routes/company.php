<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix("/company")->group(function() {
    Route::middleware("auth:sanctum")->group(function() {
        Route::post("/", [CompanyController::class, "create"]);
    });
});