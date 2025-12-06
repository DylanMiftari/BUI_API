<?php

namespace App\Policies;

use App\Enums\LoanRequestStatus;
use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LoanRequestPolicy
{

    public function denyFromBank(User $user, LoanRequest $loanRequest) {
        if($loanRequest->status != LoanRequestStatus::WAIT_ON_BANK) {
            return Response::deny("Loan request is not waiting on bank");
        }
        return Response::allow();
    }

}
