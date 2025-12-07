<?php

namespace App\Http\Actions\Bank\LoanRequest;

use App\Enums\LoanRequestStatus;
use App\Models\LoanRequest;

class CancelLoanRequestAction
{
    public function handle(LoanRequest $loanRequest, string $reason = null) {
        if($reason != null) {
            $loanRequest->description .= "\n---\nCancel Reason : ".$reason;
        }
        $loanRequest->status = LoanRequestStatus::CANCELED;
        $loanRequest->save();
    }
}
