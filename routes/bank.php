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
            Route::patch("/transfer", [BankController::class, "transferMoney"]);

            Route::prefix("/loan")->middleware("check_company_level:3")->group(function () {
                Route::post("/", [BankController::class, "createLoanRequest"]);
                Route::get("/", [BankController::class, "getLoanRequestsForClient"]);

                Route::prefix("/{loanRequest}")->middleware("check_loan_request_owner_user")->group(function () {
                    Route::patch("/", [BankController::class, "updateLoanRequestFromClient"]);
                    Route::patch("/cancel", [BankController::class, "cancelLoanRequest"]);
                });
            });
        });

        Route::prefix("/owner")->middleware("check_bank_ownership")->group(function () {
            Route::get("/accounts", [BankController::class, "getAccountsForOwner"]);
            Route::get("/loans", [BankController::class, "getLoanRequestsForOwner"]);

            Route::prefix("/loans/{loanRequest}")->middleware("check_loan_request_owner_bank")->group(function () {
                Route::patch("deny", [BankController::class, "denyLoanRequestFromBank"]);
                Route::patch("/", [BankController::class, "updateLoanRequestFromBank"]);
                Route::patch("/approve", [BankController::class, "approveLoanRequestFromBank"]);
            });
        });
    });
});
