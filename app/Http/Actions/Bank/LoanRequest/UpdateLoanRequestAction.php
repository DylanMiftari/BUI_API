<?php

namespace App\Http\Actions\Bank\LoanRequest;

use App\Enums\LoanRequestStatus;
use App\Http\Requests\Bank\LoanRequest\UpdateLoanRequestRequest;
use App\Models\LoanRequest;

class UpdateLoanRequestAction
{
    public function handle(LoanRequest $loanRequest, UpdateLoanRequestRequest $request, bool $fromBank) {
        if($request->has("money")) {
            $loanRequest->money = $request->input("money");
        }
        if($request->has("weeklyPayment")) {
            $loanRequest->weeklyPayment = $request->input("weeklyPayment");
        }
        if($request->has("rate")) {
            $loanRequest->rate = $request->input("rate");
        }
        if($request->has("description")) {
            $loanRequest->description .= "\n---\n".$request->input("description");
        }
        $loanRequest->status = $fromBank ? LoanRequestStatus::WAIT_ON_CLIENT : LoanRequestStatus::WAIT_ON_BANK;

        $loanRequest->save();
    }
}
