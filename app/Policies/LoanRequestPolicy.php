<?php

namespace App\Policies;

use App\Enums\LoanRequestStatus;
use App\Helpers\Money;
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

    public function updateLoanRequestFromBank(User $user, LoanRequest $loanRequest) {
        if($loanRequest->status != LoanRequestStatus::WAIT_ON_BANK) {
            return Response::deny("Loan request is not waiting on bank");
        }
        return Response::allow();
    }

    public function approveLoanRequestFromBank(User $user, LoanRequest $loanRequest) {
        if($loanRequest->status != LoanRequestStatus::WAIT_ON_BANK) {
            return Response::deny("Loan request is not waiting on bank");
        }
        if($loanRequest->rate == null) {
            return Response::deny("No rate is defined for this loan request");
        }
        return Response::allow();
    }

    public function updateLoanRequestFromClient(User $user, LoanRequest $loanRequest) {
        if($loanRequest->status != LoanRequestStatus::WAIT_ON_CLIENT) {
            return Response::deny("Loan request is not waiting on client");
        }
        return Response::allow();
    }

    public function cancelLoanRequest(User $user, LoanRequest $loanRequest) {
        if($loanRequest->status != LoanRequestStatus::WAIT_ON_CLIENT) {
            return Response::deny("Loan request is not waiting on client");
        }
        return Response::allow();
    }

    public function acceptLoanRequest(User $user, LoanRequest $loanRequest) {
        if($loanRequest->status != LoanRequestStatus::APPROVED) {
            return Response::deny("Loan request is not approved");
        }
        Money::canStore($loanRequest->money);
        if($loanRequest->bank->company->moneyInSafe <= $loanRequest->money) {
            return Response::deny("Bank has not enough money to pay you");
        }
        return Response::allow();
    }

}
