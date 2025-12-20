<?php

namespace App\Services;

use App\Http\Requests\Bank\DepositWithDrawResourceRequest;
use App\Models\BankAccount;
use App\Models\BankAccountTransaction;
use App\Models\BankResourceAccount;
use App\Models\User;
use App\Models\UserResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class BankAccountService
{

    public function getAllValidBankAccounts(User $user) {
        return $user->bankAccounts()->where("isEnable", true)
            ->whereHas("bank", function($q) {
                $q->whereHas("company", fn($qq) => $qq->where("activated", true));
            })
            ->get();
    }

    public function getAccountsCapacity(User $user) {
        $allAccounts = $this->getAllValidBankAccounts($user);
        return $allAccounts->sum("maxMoney");
    }

    public function getBankAccountWithHigherTransferRate(User $user): BankAccount|null {
        $allAccounts = $this->getAllValidBankAccounts($user);
        return $allAccounts->sortByDesc("transferCost")->first();
    }

    public function creditBankAccount(BankAccount $account, float $money, string $description = "") {
        $company = $account->bank->company;

        $company->moneyInSafe = round($company->moneyInSafe + $money, 2);
        $company->save();
        $account->money = round($account->money + $money, 2);
        $account->save();

        $this->createBankAccountTransaction($money, $account, true, $description);
    }

    public function debitBankAccount(BankAccount $account, float $price, string $description = "") {
        $company = $account->bank->company;
        $transferCost = round($account->transferCost * $price / 100, 2);

        $company->moneyInSafe = round($company->moneyInSafe - $price, 2);
        if($company->moneyInSafe <= 0) {
            $company->activated = false;
        }
        $company->save();
        $account->money = round($account->money - $price - $transferCost, 2);
        $account->save();

        $this->createBankAccountTransaction($price, $account, false, $description);
    }

    public function depositResources(DepositWithDrawResourceRequest $request, BankAccount $bankAccount) {
        $user = Auth::user();
        $resourcesToAdd = $request->input("resources");
        $resourceToAddIds = Arr::pluck($resourcesToAdd, "resourceId");
        $userResources = $user->userResources()->whereIn("resourceId", $resourceToAddIds)->get();
        $bankAccountResources = $bankAccount->bankResourceAccount()->whereIn("resourceId", $resourceToAddIds)->get();
        foreach($resourcesToAdd as $resource) {
            // Remove resource from user
            $currentUserResource = $userResources->where("resourceId", $resource['resourceId'])->first();
            if ($currentUserResource) {
                $removedQuantity = min($resource['quantity'], $currentUserResource->quantity);
                $currentUserResource->quantity = round($currentUserResource->quantity - $removedQuantity, 2);
                $currentUserResource->save();
                if($currentUserResource->quantity == 0) {
                    $currentUserResource->delete();
                }

                // Add resources on bankAccount
                $currentAccountResource = $bankAccountResources->where("resourceId", $resource['resourceId'])->first();
                if($currentAccountResource) {
                    $currentAccountResource->quantity = round($currentAccountResource->quantity + $removedQuantity, 2);
                    $currentAccountResource->save();
                } else if($removedQuantity > 0) {
                    BankResourceAccount::create([
                        "bankAccountId" => $bankAccount->id,
                        "resourceId" => $resource['resourceId'],
                        "quantity" => $removedQuantity,
                    ])->save();
                }
            }
        }
    }

    public function withDrawResource(DepositWithDrawResourceRequest $request, BankAccount $bankAccount) {
        $user = Auth::user();
        $resourcesToRemove = $request->input("resources");
        $resourceToRemoveIds = Arr::pluck($resourcesToRemove, "resourceId");
        $userResources = $user->userResources()->whereIn("resourceId", $resourceToRemoveIds)->get();
        $bankAccountResources = $bankAccount->bankResourceAccount()->whereIn("resourceId", $resourceToRemoveIds)->get();
        foreach($resourcesToRemove as $resource) {
            // Remove resource from bankAccount
            $currentAccountResource = $bankAccountResources->where("resourceId", $resource['resourceId'])->first();
            if ($currentAccountResource) {
                $removedQuantity = min($resource['quantity'], $currentAccountResource->quantity);
                $currentAccountResource->quantity = round($currentAccountResource->quantity - $removedQuantity, 2);
                $currentAccountResource->save();
                if($currentAccountResource->quantity == 0) {
                    $currentAccountResource->delete();
                }

                // Add resources on user
                $currentUserResource = $userResources->where("resourceId", $resource['resourceId'])->first();
                if($currentUserResource) {
                    $currentUserResource->quantity = round($currentUserResource->quantity + $removedQuantity, 2);
                    $currentUserResource->save();
                } else if($removedQuantity > 0) {
                    UserResource::create([
                        "userId" => $user->id,
                        "resourceId" => $resource['resourceId'],
                        "quantity" => $removedQuantity,
                    ])->save();
                }
            }
        }
    }


    public function createBankAccountTransaction(float $money, BankAccount $account, bool $isCredit = false, string $description = ""): BankAccountTransaction {
        $transaction = new BankAccountTransaction();
        $transaction->money = $money;
        $transaction->description = $description;
        $transaction->bankAccountId = $account->id;
        $transaction->transfert_cost = $isCredit ? 0 : $account->transferCost;
        $transaction->isCredit = $isCredit;
        $transaction->save();

        return $transaction;
    }

    public function transferMoney(BankAccount $sourceAccount, BankAccount $destinationAccount, float $amount) {
        $this->debitBankAccount($sourceAccount, $amount, "Money transfer to : ".$destinationAccount->user->pseudo);
        $this->creditBankAccount($destinationAccount, $amount, "Money transfer from : ".$sourceAccount->user->pseudo);
    }

}
