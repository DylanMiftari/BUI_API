<?php

namespace App\Policies;

use App\Models\Bank;
use App\Models\BankAccount;
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

    public function creditAccount(User $user, Bank $bank) {
        $account = $this->bankService->getBankAccount($bank, $user);
        $amountToCredit = request()->input('amount');
        if($account->creditCapacity() < $amountToCredit) {
            return Response::deny("Your account does not store the credit amount");
        }
        if($user->playerMoney < $amountToCredit) {
            return Response::deny("You don't have enough money on you");
        }
        return Response::allow();
    }

    public function transferMoney(User $user, Bank $bank) {
        $sourceAccount = $this->bankService->getBankAccount($bank, $user);
        $destinationAccount = BankAccount::find(request()->input('destinationAccount'));
        $amountToTransfer = request()->input('amount');

        if($sourceAccount->debitCapacity() < $amountToTransfer) {
            return Response::deny("Your account does not have enough money");
        }
        if($destinationAccount->creditCapacity() < $amountToTransfer) {
            return Response::deny("Destination account can not store the money");
        }
        return Response::allow();
    }
}
