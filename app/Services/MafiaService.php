<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Home;
use App\Models\Mafia;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MafiaService
{
    public const TARGET_LIMIT = 5;

    public function generateSeed(Mafia $mafia, User $user): string {
        $day = Carbon::now()->format('Ymd');
        return strval($mafia->id).strval($user->id).$day;
    }

    public function getTargetPlayer(Mafia $mafia, string $seed) {
        return User::where("city_id", $mafia->company->cityId)
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetAiDronePlayer(Mafia $mafia, string $seed) {
        return User::where("city_id", $mafia->company->cityId)
            ->where("playerMoney", ">=", 3500)
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetCompany(Mafia $mafia, string $seed) {
        return Company::where("activated", 1)->where("cityId", $mafia->company->cityId)
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetCyberAttack(Mafia $mafia, string $seed) {
        return Company::where("activated", 1)->where("cityId", $mafia->company->cityId)
            ->where("companyLevel", ">=", 3)
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetShoplifting(Mafia $mafia, string $seed) {
        return Company::where("activated", 1)->where("cityId", $mafia->company->cityId)
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetBankAccount(Mafia $mafia, string $seed) {
        return BankAccount::where("isEnable", 1)
            ->whereHas("bank.company", fn($q) => $q->where("cityId", $mafia->company->cityId))
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetPhishing(Mafia $mafia, string $seed) {
        return BankAccount::where("isEnable", 1)
            ->whereHas("bank.company", fn($q) => $q->where("cityId", $mafia->company->cityId))
            ->where("money", ">=", 10000)
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetHouse(Mafia $mafia, string $seed) {
        return Home::whereHas("house", fn($q) => $q->where("cityId", $mafia->company->cityId))
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }

    public function getTargetAiDroneHouse(Mafia $mafia, string $seed) {
        return Home::whereHas("house", fn($q) => $q->where("cityId", $mafia->company->cityId))
            ->where("moneyInSafe", ">=", 3500)
            ->inRandomOrder($seed)->limit(self::TARGET_LIMIT)->get();
    }
}
