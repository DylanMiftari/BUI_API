<?php

use App\Http\Controllers\MineController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth:sanctum", "in_travel"])->prefix("/mine")->group(function() {
    Route::get("/", [MineController::class, "index"]);
    Route::post("/buy", [MineController::class, "buyNewMine"]);

    Route::middleware(["check_mine_owner"])->prefix("/{mine}")->group(function() {
        Route::get("/", [MineController::class, "show"]);

        Route::middleware(["mine_not_processing"])->group(function() {
            Route::patch("/upgrade", [MineController::class, "upgrade"]);
            Route::patch("/process", [MineController::class, "process"]);
        });
        Route::middleware(["mine_processing"])->group(function() {
            Route::patch("/collect", [MineController::class, "collect"]);
        });
    });
});