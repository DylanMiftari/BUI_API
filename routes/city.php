<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;


Route::prefix("/city")->middleware(["auth:sanctum", "in_travel"])->group(function() {
    Route::prefix("/my")->group(function() {
        Route::get("/", [CityController::class, "myCity"]);
        Route::get("/company", [CityController::class, "myCityCompanies"]);
    });
});