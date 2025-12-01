<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Models\BankAccountTransaction;
use App\Models\User;

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
        $transferCost = round($account->transferCost * $price, 2);

        $company->moneyInSafe = round($company->moneyInSafe - $price, 2);
        if($company->moneyInSafe <= 0) {
            $company->activated = false;
        }
        $company->save();
        $account->money = round($account->money - $price - $transferCost, 2);
        $account->save();

        $this->createBankAccountTransaction($price, $account, false, $description);
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

}
