<?php

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::prefix("/resource")->group(function() {
    Route::get("/", [ResourceController::class, "index"]);
});