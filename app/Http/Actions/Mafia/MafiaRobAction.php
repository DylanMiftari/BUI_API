<?php

namespace App\Http\Actions\Mafia;

use App\Enums\MafiaContractStatus;
use App\Enums\MafiaTargetType;
use App\Models\MafiaContract;
use App\Models\User;
use App\Services\MafiaService;
use Carbon\Carbon;

class MafiaRobAction
{
    public function __construct(private MafiaService $mafiaService)
    {
    }

    public function handle(MafiaContract $mafiaContract) {
        $result = [];
        switch ($mafiaContract->targetType) {
            case MafiaTargetType::USER:
                $result = $this->mafiaService->robPlayer($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::COMPANY:
                $result = $this->mafiaService->robCompany($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::BANK_ACCOUNT:
                $result = $this->mafiaService->robBankAccount($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::HOME:
                $result = $this->mafiaService->robHome($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::CYBERATTACK:
                $result = $this->mafiaService->robCyberattack($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::USER_DRONE:
                $result = $this->mafiaService->robUserDrone($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::HOME_DRONE:
                $result = $this->mafiaService->robHomeDrone($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::SHOPLIFTING:
                $result = $this->mafiaService->robShoplifting($mafiaContract->target, $mafiaContract->mafia);
                break;
            case MafiaTargetType::PHISHING:
                $result = $this->mafiaService->robPhishing($mafiaContract->target, $mafiaContract->mafia);
                break;
        }

        $company = $mafiaContract->mafia->company;
        $company->moneyInSafe = round($company->moneyInSafe + $result["winnings"], 2);
        $company->moneyInSafe = round($company->moneyInSafe - $result["cost"], 2);
        $company->save();

        $mafiaContract->robState = MafiaContractStatus::ROBED;
        $mafiaContract->robSuccess = $result["success"];
        $mafiaContract->robWinnings = $result["winnings"];
        $mafiaContract->robCost = $result["cost"];
        $mafiaContract->robDate = Carbon::now();
        $mafiaContract->save();

        return $result;
    }
}
