<?php

namespace App\Http\Actions\Bank;

use App\Models\BankAccount;
use App\Models\User;
use App\Services\BankAccountService;

class CreditAccountAction
{
    public function __construct(
        private BankAccountService $bankAccountService,
    )
    {
    }

    public function handle(BankAccount $account, User $user, float $amount) {
        $this->bankAccountService->creditBankAccount($account, $amount, "Account credit");

        $user->playerMoney = round($user->playerMoney - $amount, 2);
        $user->save();
    }
}
