<?php

namespace App\Http\Actions\Bank\LoanRequest;

use App\Enums\LoanRequestStatus;
use App\Models\LoanRequest;

class ApproveLoanRequestAction
{
    public function handle(LoanRequest $loanRequest) {
        $loanRequest->status = LoanRequestStatus::APPROVED;
        $loanRequest->save();
    }
}
