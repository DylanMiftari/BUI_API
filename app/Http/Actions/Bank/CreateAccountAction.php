<?php

namespace App\Http\Actions\Bank;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\User;

class CreateAccountAction
{

    public function handle(User $user, Bank $bank): BankAccount {
        $bankAccount = new BankAccount();
        $bankAccount->accountMaintenanceCost = $bank->accountMaintenanceCost;
        $bankAccount->transferCost = $bank->transferCost;
        $bankAccount->money = 0;
        $bankAccount->maxMoney = $bank->maxAccountMoney;
        $bankAccount->maxResource = $bank->maxAccountResource;
        $bankAccount->userId = $user->id;
        $bankAccount->bankId = $bank->id;
        $bankAccount->isEnable = 1;
        $bankAccount->save();

        return $bankAccount;
    }

}
