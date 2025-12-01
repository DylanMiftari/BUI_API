<?php

use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;

Route::prefix("/bank")->middleware("auth:sanctum")->group(function () {
    Route::get("/bank-accounts", [BankController::class, "getBankAccounts"]);
});
