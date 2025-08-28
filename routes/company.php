<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix("/company")->group(function() {
    Route::middleware(["auth:sanctum", "in_travel"])->group(function() {
        Route::get("/my", [CompanyController::class, "getCompaniesOfPlayer"]);
        Route::post("/", [CompanyController::class, "create"]);
    });
});
