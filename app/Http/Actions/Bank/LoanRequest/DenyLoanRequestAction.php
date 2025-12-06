<?php

namespace App\Http\Actions\Bank\LoanRequest;

use App\Enums\LoanRequestStatus;
use App\Models\LoanRequest;

class DenyLoanRequestAction
{

    public function handle(LoanRequest $loanRequest, string $reason = null) {
        $loanRequest->status = LoanRequestStatus::DENY;
        if($reason) {
            $loanRequest->description .= "\n---\nDeny Reason:\n$reason";
        }
        $loanRequest->save();
    }

}
