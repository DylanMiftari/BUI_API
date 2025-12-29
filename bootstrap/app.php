<?php

use App\Http\Middleware\Bank\CheckBankAccountOwnerBank;
use App\Http\Middleware\Bank\CheckBankOwnershipMiddleware;
use App\Http\Middleware\Bank\CheckLoanRequestOwnerBankMiddleware;
use App\Http\Middleware\Bank\CheckLoanRequestOwnerClient;
use App\Http\Middleware\Bank\HaveAccountMiddleware;
use App\Http\Middleware\Bank\NotHaveBankAccountMiddleware;
use App\Http\Middleware\Casino\CasinoIsActivated;
use App\Http\Middleware\Casino\CheckBlackjackPartyOwnerMiddleware;
use App\Http\Middleware\Casino\CheckCasinoOwnershipMiddleware;
use App\Http\Middleware\Casino\CheckTicketMiddleware;
use App\Http\Middleware\Company\CheckCompanyLevelMiddleware;
use App\Http\Middleware\Company\CheckCompanyOwernshipMiddleware;
use App\Http\Middleware\InTravelMiddleware;
use App\Http\Middleware\Mafia\UserHaveAlreadyContractMiddleware;
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
            __DIR__.'/../routes/bank.php',
            __DIR__.'/../routes/home.php',
            __DIR__.'/../routes/mafia.php',
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
            "casino_activated" => CasinoIsActivated::class,
            "check_company_level" => CheckCompanyLevelMiddleware::class,
            "check_casino_ticket" => CheckTicketMiddleware::class,
            "check_blackjack_part_owner" => CheckBlackjackPartyOwnerMiddleware::class,
            "check_casino_ownership" => CheckCasinoOwnershipMiddleware::class,
            "not_have_bank_account" => NotHaveBankAccountMiddleware::class,
            "have_bank_account" => HaveAccountMiddleware::class,
            "check_bank_ownership" => CheckBankOwnershipMiddleware::class,
            "check_loan_request_owner_bank" => CheckLoanRequestOwnerBankMiddleware::class,
            "check_loan_request_owner_user" => CheckLoanRequestOwnerClient::class,
            "check_bank_account_owner_bank" => CheckBankAccountOwnerBank::class,
            "user_have_already_contract" => UserHaveAlreadyContractMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
