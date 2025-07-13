<?php

use App\Http\Controllers\MineController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth:sanctum", "in_travel"])->prefix("/mine")->group(function() {
    Route::get("/", [MineController::class, "index"]);

    Route::middleware(["check_mine_owner"])->prefix("/{mine}")->group(function() {

        Route::middleware(["mine_not_processing"])->group(function() {
            Route::patch("/upgrade", [MineController::class, "upgrade"]);
            Route::patch("/process", [MineController::class, "process"]);
        });
    });
});