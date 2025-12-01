<?php

namespace App\Http\Controllers;

use App\Http\Actions\Bank\CreateAccountAction;
use App\Http\Resources\BankAccountResource;
use App\Models\Bank;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    use AuthorizesRequests;
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
}
