<?php

namespace App\Http\Actions\Mafia;

use App\Enums\MafiaContractStatus;
use App\Helpers\Money;
use App\Models\MafiaContract;

class AcceptMafiaContractAction {
    public function handle(MafiaContract $mafiaContract) {
        $mafiaId = $mafiaContract->mafiaId;
        $company = $mafiaContract->mafia->company;
        $mafiaName = $company->name;
        Money::pay($mafiaContract->clientPrice, "Pay the contract n°$mafiaContract->id to the mafia : $mafiaName");

        $mafiaContract->robState = MafiaContractStatus::PAYED;
        $mafiaContract->save();

        $company->moneyInSafe = round($company->moneyInSafe + $mafiaContract->clientPrice, 2);
        $company->save();
    }
}
