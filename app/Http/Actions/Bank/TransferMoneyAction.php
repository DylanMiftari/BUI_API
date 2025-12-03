<?php

namespace App\Http\Actions\Bank;

use App\Models\BankAccount;
use App\Services\BankAccountService;

class TransferMoneyAction
{
    public function __construct(
        private BankAccountService $bankAccountService,
    )
    {
    }

    public function handle(BankAccount $sourceBankAccount, BankAccount $destinationBankAccount, float $amount) {
        $this->bankAccountService->transferMoney($sourceBankAccount, $destinationBankAccount, $amount);
    }
}
