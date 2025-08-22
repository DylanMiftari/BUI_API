<?php

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::prefix("/resource")->group(function() {
    Route::get("/", [ResourceController::class, "index"]);

    Route::middleware(["auth:sanctum", "in_travel"])->group(function() {
        Route::patch("/sell", [ResourceController::class, "sell"]);
    });
});