<?php

namespace App\Providers;

use App\Enums\MafiaTargetType;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Home;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        Schema::defaultStringLength(191);

        Relation::enforceMorphMap([
            MafiaTargetType::USER->value => User::class,
            MafiaTargetType::COMPANY->value => Company::class,
            MafiaTargetType::BANK_ACCOUNT->value => BankAccount::class,
            MafiaTargetType::HOME->value => Home::class,
            MafiaTargetType::CYBERATTACK->value => Company::class,
            MafiaTargetType::USER_DRONE->value => User::class,
            MafiaTargetType::HOME_DRONE->value => Home::class,
            MafiaTargetType::SHOPLIFTING->value => Company::class,
            MafiaTargetType::PHISHING->value => BankAccount::class,
        ]);
    }
}
