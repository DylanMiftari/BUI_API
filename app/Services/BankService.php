<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\User;

class BankService
{
    public function getBankAccount(Bank $bank, User $user): BankAccount|null {
        return BankAccount::where("userId", $user->id)
            ->where("bankId", $bank->id)
            ->first();
    }
}
