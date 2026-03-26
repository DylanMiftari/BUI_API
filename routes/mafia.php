<?php

use App\Http\Controllers\MafiaController;
use Illuminate\Support\Facades\Route;


Route::prefix("mafia")->middleware(["auth:sanctum", "in_travel"])->group(function () {
    Route::get("/contracts", [MafiaController::class, "getPlayerContracts"]);
    Route::prefix("/{mafia}")->group(function () {
        Route::get("/", [MafiaController::class, "getMafiaForClient"]);
        Route::get("/targets", [MafiaController::class, "getTargets"]);

        Route::prefix("contract")->group(function () {
            Route::post("/", [MafiaController::class, "createContract"])->middleware("user_have_already_contract");
            Route::get("/", [MafiaController::class, "getContractForClient"]);

            Route::prefix("{mafiaContract}")->middleware("check_contract_ownership")->group(function () {
                Route::patch("/updatePrice", [MafiaController::class, "updatePriceForClient"]);
            });
        });

        Route::middleware("check_mafia_ownership")->group(function () {
            Route::get("/owner", [MafiaController::class, "getMafiaForOwner"]);
            Route::prefix("owner/contract/{mafiaContract}")->group(function () {
                Route::patch("/updatePrice", [MafiaController::class, "updatePriceForOwner"]);
            });
        });
    });
});
