<?php

use App\Http\Controllers\MineController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth:sanctum", "in_travel"])->prefix("/mine")->group(function() {
    Route::get("/", [MineController::class, "index"]);
});