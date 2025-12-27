<?php

use App\Http\Controllers\MafiaController;
use Illuminate\Support\Facades\Route;


Route::prefix("mafia")->middleware(["auth:sanctum", "in_travel"])->group(function () {
    Route::prefix("/{mafia}")->group(function () {
        Route::get("/", [MafiaController::class, "getMafiaForClient"]);
        Route::get("/targets", [MafiaController::class, "getTargets"]);
    });
});
