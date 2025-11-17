<?php

use App\Http\Middleware\Casino\CasinoIsActivated;
use App\Http\Middleware\Company\CheckCompanyOwernshipMiddleware;
use App\Http\Middleware\InTravelMiddleware;
use App\Http\Middleware\Mine\CheckMineOwnerMiddleware;
use App\Http\Middleware\Mine\MineNotProcessingMiddleware;
use App\Http\Middleware\Mine\MineProcessingMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: [
            __DIR__.'/../routes/api.php',
            __DIR__.'/../routes/resource.php',
            __DIR__.'/../routes/company.php',
            __DIR__.'/../routes/mine.php',
            __DIR__.'/../routes/city.php',
            __DIR__.'/../routes/casino.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            "in_travel" => InTravelMiddleware::class,
            "check_mine_owner" => CheckMineOwnerMiddleware::class,
            "mine_not_processing" => MineNotProcessingMiddleware::class,
            "mine_processing" => MineProcessingMiddleware::class,
            "company_ownership" => CheckCompanyOwernshipMiddleware::class,
            "casino_activated" => CasinoIsActivated::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
