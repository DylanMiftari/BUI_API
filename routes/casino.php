<?php

use App\Http\Controllers\CasinoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/casino')->middleware("auth:sanctum")->group(function(){
    Route::get("/tickets", [CasinoController::class, 'playerTickets']);
    Route::prefix("/{casino}")->middleware("casino_activated")->group(function(){
        Route::post("/buy", [CasinoController::class, "buyTicket"]);
    });
});
