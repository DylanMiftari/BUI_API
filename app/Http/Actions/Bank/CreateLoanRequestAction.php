<?php

namespace App\Http\Actions\Bank;

use App\Enums\LoanRequestStatus;
use App\Models\Bank;
use App\Models\LoanRequest;
use App\Models\User;

class CreateLoanRequestAction
{
    public function handle(User $user, Bank $bank, float $money, float $weeklyPayment,
                           string $description, float $rate = null
    ): LoanRequest {
        $loanRequest = new LoanRequest();
        $loanRequest->status = LoanRequestStatus::WAIT_ON_BANK;
        $loanRequest->money = $money;
        $loanRequest->weeklypayment = $weeklyPayment;
        $loanRequest->rate = $rate;
        $loanRequest->description = $description;
        $loanRequest->userId = $user->id;
        $loanRequest->bankId = $bank->id;
        $loanRequest->save();

        return $loanRequest;
    }
}
