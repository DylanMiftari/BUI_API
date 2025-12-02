<?php

namespace App\Policies;

use App\Models\Bank;
use App\Models\User;
use App\Services\BankService;
use Illuminate\Auth\Access\Response;

class BankPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct(
        private BankService $bankService,
    )
    {
        //
    }

    public function createAccount(User $user, Bank $bank) {
        $maxNbAccount = $bank->bankLevel->maxNbAccount;
        $nbAccount = $bank->bankAccounts()->count();
        if($nbAccount >= $maxNbAccount) {
            return Response::deny("This bank is already full");
        }
        return Response::allow();
    }

    public function debitAccount(User $user, Bank $bank) {
        $account = $this->bankService->getBankAccount($bank, $user);
        $amountToDebit = request()->input('amount');
        if($account->debitCapacity() < $amountToDebit) {
            return Response::deny("Your account does not have enough money");
        }
        if($user->playerMoney + $amountToDebit > (float)config("user.max_player_money")) {
            return Response::deny("You can't store this amount of money on you");
        }
        return Response::allow();
    }
}
