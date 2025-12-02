<?php

namespace App\Http\Controllers;

use App\Http\Actions\Bank\CreateAccountAction;
use App\Http\Actions\Bank\DebitAccountAction;
use App\Http\Requests\Bank\DebitAccountRequest;
use App\Http\Resources\BankAccountResource;
use App\Models\Bank;
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
}
