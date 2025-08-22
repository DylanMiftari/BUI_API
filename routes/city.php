<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;


Route::prefix("/city")->middleware(["auth:sanctum", "in_travel"])->group(function() {
    Route::get("/my", [CityController::class, "myCity"]);
});