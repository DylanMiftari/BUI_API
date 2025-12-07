<?php

namespace App\Http\Actions\Bank\LoanRequest;

use App\Enums\LoanRequestStatus;
use App\Helpers\Money;
use App\Models\LoanRequest;
use App\Models\User;

class AcceptLoanRequestAction
{
    public function handle(LoanRequest $loanRequest, User $user) {
        $bank = $loanRequest->bank;
        Money::creditMoney($loanRequest->money, "Loan of $loanRequest->money €, from $bank->name bank");

        $bank->company->refresh();
        $bank->company->moneyInSafe = round($bank->company->moneyInSafe - $loanRequest->money, 2);
        $bank->company->save();

        $loanRequest->status = LoanRequestStatus::PAYING;
        $loanRequest->save();
    }
}
