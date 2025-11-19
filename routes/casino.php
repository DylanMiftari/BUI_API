<?php

use App\Http\Controllers\CasinoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/casino')->middleware("auth:sanctum")->group(function(){
    Route::get("/tickets", [CasinoController::class, 'playerTickets']);
    Route::prefix("/{casino}")->middleware("casino_activated")->group(function(){
        Route::post("/buy", [CasinoController::class, "buyTicket"]);

        Route::prefix("/game")->middleware("check_casino_ticket")->group(function(){
            Route::post("/roulette", [CasinoController::class, "playRoulette"])->middleware("check_company_level:1");
            Route::post("/dice", [CasinoController::class, "playDice"])->middleware("check_company_level:2");
            Route::post("/poker", [CasinoController::class, "playPoker"])->middleware("check_company_level:3");

            Route::prefix("/blackjack")->middleware("check_company_level:4")->group(function(){
                Route::post("/init", [CasinoController::class, "initBlackjack"]);
                Route::prefix("/{blackjack_party}")->middleware("check_blackjack_part_owner")->group(function(){
                    Route::patch("/hit", [CasinoController::class, "hitBlackjack"]);
                });
            });
        });
    });
});
