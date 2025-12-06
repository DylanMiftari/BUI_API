<?php

namespace App\Http\Controllers;

use App\Helpers\With;
use App\Http\Actions\Bank\CreateAccountAction;
use App\Http\Actions\Bank\CreateLoanRequestAction;
use App\Http\Actions\Bank\CreditAccountAction;
use App\Http\Actions\Bank\DebitAccountAction;
use App\Http\Actions\Bank\LoanRequest\DenyLoanRequestAction;
use App\Http\Actions\Bank\TransferMoneyAction;
use App\Http\Requests\Bank\CreateLoanRequestRequest;
use App\Http\Requests\Bank\CreditAccountRequest;
use App\Http\Requests\Bank\DebitAccountRequest;
use App\Http\Requests\Bank\LoanRequest\DenyLoanRequestRequest;
use App\Http\Requests\Bank\TransferMoneyRequest;
use App\Http\Resources\BankAccountResource;
use App\Http\Resources\LoanRequestResource;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\LoanRequest;
use App\Services\BankService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private BankService $bankService
    )
    {
    }

    //
    public function getBankAccounts()
    {
        return BankAccountResource::collection(Auth::user()->bankAccounts);
    }

    public function createBankAccount(Bank $bank, CreateAccountAction $action)
    {
        $this->authorize("createAccount", $bank);

        $bankAccount = $action->handle(Auth::user(), $bank);

        return new BankAccountResource($bankAccount);
    }

    public function getBankAccount(Bank $bank)
    {
        return new BankAccountResource($this->bankService->getBankAccount($bank, Auth::user()));
    }

    public function debitBankAccount(DebitAccountRequest $request, Bank $bank, DebitAccountAction $action)
    {
        $this->authorize("debitAccount", $bank);

        $action->handle(
            $this->bankService->getBankAccount($bank, Auth::user()),
            Auth::user(),
            $request->input("amount")
        );

        return response()->noContent();
    }

    public function creditBankAccount(CreditAccountRequest $request, Bank $bank, CreditAccountAction $action)
    {
        $this->authorize("creditAccount", $bank);

        $action->handle(
            $this->bankService->getBankAccount($bank, Auth::user()),
            Auth::user(),
            $request->input("amount")
        );

        return response()->noContent();
    }

    public function transferMoney(TransferMoneyRequest $request, Bank $bank, TransferMoneyAction $action)
    {
        $this->authorize("transferMoney", $bank);

        $action->handle(
            $this->bankService->getBankAccount($bank, Auth::user()),
            BankAccount::find($request->input("destinationAccount")),
            $request->input("amount")
        );

        return response()->noContent();
    }

    public function createLoanRequest(CreateLoanRequestRequest $request, Bank $bank, CreateLoanRequestAction $action)
    {
        $loanRequest = $action->handle(
            Auth::user(),
            $bank,
            $request->input("money"),
            $request->input("weeklyPayment"),
            $request->input("description"),
            $request->input("rate")
        );

        return new LoanRequestResource($loanRequest);
    }

    public function getLoanRequestsForClient(Bank $bank)
    {
        return LoanRequestResource::collection(Auth::user()->loanRequestForBank($bank));
    }

    public function getAccountsForOwner(Bank $bank)
    {
        With::add("user");
        return BankAccountResource::collection($bank->bankAccounts);
    }

    public function getLoanRequestsForOwner(Bank $bank)
    {
        With::add("user");
        return LoanRequestResource::collection($bank->loanRequests);
    }

    /**
     * Bank deny the loan request
     * @param Bank $bank
     * @param LoanRequest $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function denyLoanRequestFromBank(DenyLoanRequestRequest $request, Bank $bank, LoanRequest $loanRequest, DenyLoanRequestAction $action)
    {
        $this->authorize("denyFromBank", $loanRequest);
        $action->handle($loanRequest, $request->input("reason"));

        return response()->noContent();
    }
}
