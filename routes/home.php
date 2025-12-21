<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix("/home")->middleware("auth:sanctum")->group(function () {
    Route::get("", [HomeController::class, "index"]);
});
