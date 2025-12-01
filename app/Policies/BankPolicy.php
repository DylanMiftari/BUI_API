<?php

namespace App\Policies;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BankPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
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
}
