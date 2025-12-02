<?php

use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;

Route::prefix("/bank")->middleware("auth:sanctum")->group(function () {
    Route::get("/bank-accounts", [BankController::class, "getBankAccounts"]);

    Route::prefix("/{bank}")->group(function () {
        Route::post("/create-account", [BankController::class, "createBankAccount"])->middleware("not_have_bank_account");

        Route::prefix("/account")->middleware("have_bank_account")->group(function () {
            Route::get("/", [BankController::class, "getBankAccount"]);
            Route::patch("/debit", [BankController::class, "debitBankAccount"]);
            Route::patch("/credit", [BankController::class, "creditBankAccount"]);
        });
    });
});
