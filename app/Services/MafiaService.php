<?php

namespace App\Services;

use App\Enums\MafiaTargetType;
use App\Exceptions\Mafia\MafiaRobCooldownException;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Home;
use App\Models\Mafia;
use App\Models\MafiaContract;
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



    /* ROB METHODS */
    public function robPlayer(User $target, Mafia $mafia) {
        $cost = config("mafia.player.costByLevel")[$mafia->level];
        $success = $this->robIsSuccess(MafiaTargetType::USER, $mafia->level);
        $winnings = 0;
        if($success) {
            $winnings = $this->getStealValue(MafiaTargetType::USER, $target->playerMoney, $mafia->level);
            $target->playerMoney = round($target->playerMoney - min($winnings, $target->playerMoney), 2);
            if($target->playerMoney < 0) {
                $target->playerMoney = 0;
            }
            $target->save();
        }

        return [
            "success" => $success,
            "winnings" => $winnings,
            "cost" => $cost,
        ];
    }

    public function robCompany(Company $target, Mafia $mafia) {
        if($this->checkRobInCooldown(MafiaTargetType::COMPANY, $target->id)) {
            return throw new MafiaRobCooldownException();
        }
        $cost = config("mafia.company.costByLevel")[$mafia->level];
        $success = $this->robIsSuccess(MafiaTargetType::COMPANY, $mafia->level, $target->companyLevel);
        $res = [
            "success" => $success,
            "cost" => $cost,
            "winnings" => 0
        ];
        if($success) {
            $winnings = $this->getStealValue(MafiaTargetType::COMPANY, $target->moneyInSafe, $mafia->level,
            $target->companyLevel);
            $res["winnings"] = min($winnings, config("mafia.company.stealValue.limit"));

            $target->moneyInSafe = round($target->moneyInSafe - $res["winnings"] , 2);
            $target->save();
        }

        return $res;
    }

    public function robBankAccount(BankAccount $target, Mafia $mafia) {
        if($this->checkRobInCooldown(MafiaTargetType::BANK_ACCOUNT, $target->id)) {
            return throw new MafiaRobCooldownException();
        }
        $cost = config("mafia.bankAccount.costByLevel")[$mafia->level];
        $success = $this->robIsSuccess(MafiaTargetType::BANK_ACCOUNT, $mafia->level, $target->bank->bankLevel);
        $res = [
            "success" => $success,
            "cost" => $cost,
            "winnings" => 0
        ];
        if($success) {
            $winnings = $this->getStealValue(MafiaTargetType::BANK_ACCOUNT, $target->money, $mafia->level,
            $target->bank->bankLevel);
            $res["winnings"] = min($winnings, config("mafia.bankAccount.stealValue.limit"));

            $target->money = round($target->money - $res["winnings"] , 2);
            $target->save();
        }

        return $res;
    }

    public function robHome(Home $target, Mafia $mafia) {
        $res = [
            "success" => $this->robIsSuccess(MafiaTargetType::HOME, $mafia->level, $target->house->houseTypeId),
            "cost" => config("mafia.house.costByLevel")[$mafia->level],
            "winnings" => 0
        ];
        if($res["success"]) {
            $res["winnings"] = $this->getStealValue(MafiaTargetType::HOME, $target->moneyInSafe, $mafia->level,
            $target->house->houseTypeId);

            $target->moneyInSafe = round($target->moneyInSafe - $res["winnings"], 2);
            $target->save();
        }
        return $res;
    }

    public function robCyberattack(Company $target, Mafia $mafia) {
        if($this->checkRobInCooldown(MafiaTargetType::CYBERATTACK, $target->id)) {
            return throw new MafiaRobCooldownException();
        }
        $res = [
            "success" => $this->robIsSuccess(MafiaTargetType::CYBERATTACK, $mafia->level, $target->id),
            "cost" => config("mafia.cyberattack.cost"),
            "winnings" => 0
        ];
        if($res["success"]) {
            $res["winnings"] = $this->getStealValue(MafiaTargetType::CYBERATTACK, $target->moneyInSafe,
            $mafia->level, $target->companyLevel);

            $target->moneyInSafe = round($target->moneyInSafe - $res["winnings"], 2);
            $target->save();
        }
        return $res;
    }

    public function robUserDrone(User $target, Mafia $mafia) {
        $res = [
            "success" => $this->robIsSuccess(MafiaTargetType::USER_DRONE, $mafia->level),
            "cost" => config("mafia.aiDrone.cost"),
            "winnings" => 0
        ];
        if($res["success"]) {
            $res["winnings"] = $this->getStealValue(MafiaTargetType::USER_DRONE, $target->playerMoney, $mafia->level);

            $target->playerMoney = round($target->playerMoney - $res["winnings"], 2);
            $target->save();
        }
        return $res;
    }

    public function robHomeDrone(Home $target, Mafia $mafia) {
        $res = [
            "success" => $this->robIsSuccess(MafiaTargetType::HOME_DRONE, $mafia->level),
            "cost" => config("mafia.aiDrone.cost"),
            "winnings" => 0
        ];
        if($res["success"]) {
            $res["winnings"] = $this->getStealValue(MafiaTargetType::HOME_DRONE, $target->moneyInSafe, $mafia->level,
            $target->house->houseTypeId);

            $target->moneyInSafe = round($target->moneyInSafe - $res["winnings"], 2);
            $target->save();
        }
        return $res;
    }

    public function robShoplifting(Company $target, Mafia $mafia) {
        $res = [
            "success" => $this->robIsSuccess(MafiaTargetType::SHOPLIFTING, $mafia->level, $target->companyLevel),
            "cost" => config("mafia.shoplifting.cost"),
            "winnings" => 0
        ];
        if($res["success"]) {
            $res["winnings"] = $this->getStealValue(MafiaTargetType::SHOPLIFTING, $target->moneyInSafe, $mafia->level,
            $target->companyLevel);

            $target->moneyInSafe = round($target->moneyInSafe - $res["winnings"], 2);
            $target->save();
        }
        return $res;
    }

    public function robPhishing(BankAccount $target, Mafia $mafia) {
        if($this->checkRobInCooldown(MafiaTargetType::BANK_ACCOUNT, $target->id)) {
            return throw new MafiaRobCooldownException();
        }
        $res = [
            "success" => $this->robIsSuccess(MafiaTargetType::PHISHING, $mafia->level, $target->bank->level),
            "cost" => config("mafia.phishing.cost"),
            "winnings" => 0
        ];
        if($res["success"]) {
            $res["winnings"] = $this->getStealValue(MafiaTargetType::PHISHING, $target->money, $mafia->level,
            $target->bank->level);

            $target->money = round($target->money - $res["winnings"], 2);
            $target->save();
        }
        return $res;
    }

    private function robIsSuccess(MafiaTargetType $targetType, int $mafiaLevel, int|null $targetLevel = null) {
        $diffLevel = $mafiaLevel;
        if($targetLevel) {
            $diffLevel = max($mafiaLevel - $targetLevel, 0);
        }
        switch ($targetType) {
            case MafiaTargetType::USER:
                $successRate = config("mafia.player.baseSuccessRate") + $mafiaLevel * config("mafia.player.successRateByLevel");
                break;
            case MafiaTargetType::COMPANY:
                $successRate = config("mafia.company.baseSuccessRate") + $diffLevel * config("mafia.company.successRateByLevel");
                break;
            case MafiaTargetType::BANK_ACCOUNT:
                $successRate = config("mafia.bankAccount.baseSuccessRate") + $diffLevel * config("mafia.bankAccount.successRateByLevel");
                break;
            case MafiaTargetType::HOME:
                $successRate = config("mafia.house.baseSuccessRate") + $diffLevel * config("mafia.house.successRateByLevel");
                break;
            case MafiaTargetType::CYBERATTACK:
                $successRate = config("mafia.cyberattack.successRate");
                break;
            case MafiaTargetType::USER_DRONE:
                $successRate = config("mafia.aiDrone.successRate.player");
                break;
            case MafiaTargetType::HOME_DRONE:
                $successRate = config("mafia.aiDrone.successRate.house");
                break;
            case MafiaTargetType::SHOPLIFTING:
                $successRate = config("mafia.shoplifting.successRate");
                break;
            case MafiaTargetType::PHISHING:
                $successRate = config("mafia.phishing.successRate");
                break;
        }
        return rand(1, 100) <= $successRate;
    }

    private function getStealValue(MafiaTargetType $targetType, float $totalMoney, int $mafiaLevel, int|null $targetLevel = null) {
        $diffLevel = $mafiaLevel;
        if($targetLevel) {
            $diffLevel = max($mafiaLevel - $targetLevel, 0);
        }

        $limit = null;
        switch ($targetType) {
            case MafiaTargetType::USER:
                $stealValueIsPercent = true;
                $minStealValue = config("mafia.player.stealValue.min") + config("mafia.player.stealValue.byLevel") * $mafiaLevel;
                $maxStealValue = config("mafia.player.stealValue.max") + config("mafia.player.stealValue.byLevel") * $mafiaLevel;
                break;
            case MafiaTargetType::COMPANY:
                $stealValueIsPercent = true;
                $minStealValue = config("mafia.company.stealValue.min") + $diffLevel * config("mafia.company.stealValue.byLevel");
                $maxStealValue = config("mafia.company.stealValue.max") + $diffLevel * config("mafia.company.stealValue.byLevel");
                $limit = config("mafia.company.stealValue.limit") * $mafiaLevel;
                break;
            case MafiaTargetType::BANK_ACCOUNT:
                $stealValueIsPercent = true;
                $minStealValue = config("mafia.bankAccount.stealValue.min") + $diffLevel * config("mafia.bankAccount.stealValue.byLevel");
                $maxStealValue = config("mafia.bankAccount.stealValue.max") + $diffLevel * config("mafia.bankAccount.stealValue.byLevel");
                $limit = config("mafia.bankAccount.stealValue.limit") * $mafiaLevel;
                break;
            case MafiaTargetType::HOME:
                $stealValueIsPercent = true;
                $minStealValue = config("mafia.house.stealValue.min") + $diffLevel * config("mafia.house.stealValue.byLevel");
                $maxStealValue = config("mafia.house.stealValue.max") + $diffLevel * config("mafia.house.stealValue.byLevel");
                break;
            case MafiaTargetType::CYBERATTACK:
                $stealValueIsPercent = false;
                $minStealValue = config("mafia.cyberattack.stealValue");
                $maxStealValue = config("mafia.cyberattack.stealValue");
                break;
            case MafiaTargetType::USER_DRONE:
            case MafiaTargetType::HOME_DRONE:
                $stealValueIsPercent = true;
                $minStealValue = config("mafia.aiDrone.stealValue.min");
                $maxStealValue = config("mafia.aiDrone.stealValue.max");
                break;
            case MafiaTargetType::SHOPLIFTING:
                $stealValueIsPercent = false;
                $minStealValue = config("mafia.shoplifting.stealValue.min") * $targetLevel;
                $maxStealValue = config("mafia.shoplifting.stealValue.max") * $targetLevel;
                break;
            case MafiaTargetType::PHISHING:
                $stealValueIsPercent = true;
                $minStealValue = config("mafia.phishing.stealValue");
                $maxStealValue = config("mafia.phishing.stealValue");
                break;
        }

        $stealValue = rand($minStealValue, $maxStealValue);
        $stealMoney = $stealValueIsPercent ? round($totalMoney * $stealValue / 100, 2) : min($stealValue, $totalMoney);
        if($limit && $stealMoney > $limit) {
            $stealMoney = $limit;
        }
        return $stealMoney;
    }

    private function checkRobInCooldown(MafiaTargetType $targetType, int $targetId) {
        switch ($targetType) {
            case MafiaTargetType::COMPANY:
                $lastAllowedDate = Carbon::now()->subDays(config("mafia.company.cooldownInDays"));
                break;
            case MafiaTargetType::BANK_ACCOUNT:
                $lastAllowedDate = Carbon::now()->subDays(config("mafia.bankAccount.cooldownInDays"));
                break;
            default:
                $lastAllowedDate = null;
        }

        return $lastAllowedDate != null && MafiaContract::where("targetId", $targetId)
            ->where("robSuccess", 1)
            ->where("robDate", ">", $lastAllowedDate)
            ->where("targetType", $targetType)
            ->exists();
    }
}
