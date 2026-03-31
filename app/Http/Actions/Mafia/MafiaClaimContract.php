<?php

namespace App\Http\Actions\Mafia;

use App\Enums\MafiaContractStatus;
use App\Helpers\Money;
use App\Models\MafiaContract;
use App\Models\User;

class MafiaClaimContract
{
    public function handle(MafiaContract $mafiaContract) {
        $company = $mafiaContract->mafia->company;
        $company->moneyInSafe = round($company->moneyInSafe - $mafiaContract->robWinnings, 2);
        $company->save();

        $mafiaContract->robState = MafiaContractStatus::FINISHED;
        $mafiaContract->save();

        Money::creditMoney($mafiaContract->robWinnings, "Withdraw of the contract n°$mafiaContract->id of the mafia $company->name");
    }
}
