<?php
namespace App\Helpers;

use App\Models\User;
use App\Services\BankAccountService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class Money {

    /**
     * Check if connected user has enough money
     *
     * This function throw error if user has not enough money
     * @param float $price
     * @throws \Illuminate\Auth\AuthenticationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return bool
     */
    public static function check(float $price) {
        $bankAccountService = app(BankAccountService::class);
        $accountWithMaxTransfer = $bankAccountService->getBankAccountWithHigherTransferRate(Auth::user());
        if($accountWithMaxTransfer) {
            $price = round($price + $price * $accountWithMaxTransfer->transferCost / 100, 2);
        }
        if(!Auth::check()) {
            throw new AuthenticationException();
        }
        $allMoney = self::getAllMoney();
        if($allMoney < $price) {
            throw new AuthorizationException("You don't have enough money, you need to have ".round($price, 2));
        }

        return $allMoney >= $price;
    }

    /**
     * Remove money from connected user
     * @param float $price
     * @return void
     */
    public static function pay(float $price, string $description = "") {
        $bankAccountService = app(BankAccountService::class);
        $allAccounts = $bankAccountService->getAllValidBankAccounts(Auth::user());
        $allAccounts = $allAccounts->shuffle();
        $payed = 0;
        $left = $price;
        foreach($allAccounts as $account) {
            $payedForAccount = min($account->debitCapacity(), $left);
            if($payedForAccount > 0) {
                $bankAccountService->debitBankAccount($account, $payedForAccount, $description);
                $payed = round($payed + $payedForAccount, 2);
                $left = round($left - $payedForAccount, 2);
            }
        }

        if ($left > 0) {
            $user = User::find(Auth::id());
            $user->playerMoney = round($user->playerMoney - $left, 2);
            $user->save();
        }
    }

    public static function creditMoney(float $money, string $description = "") {
        $bankAccountService = app(BankAccountService::class);
        $allAccounts = $bankAccountService->getAllValidBankAccounts(Auth::user());
        $allAccounts = $allAccounts->shuffle();
        $received = 0;
        $left = $money;
        foreach($allAccounts as $account) {
            $receivedForAccount = min($account->creditCapacity(), $left);
            if($receivedForAccount > 0) {
                $bankAccountService->creditBankAccount($account, $receivedForAccount, $description);
                $received = round($received + $receivedForAccount, 2);
                $left = round($left - $receivedForAccount, 2);
            }
        }

        if ($left > 0) {
            $user = User::find(Auth::id());
            $user->playerMoney = round($user->playerMoney + $left, 2);
            $user->save();
        }
    }

    public static function canStore(float $money) {
        $bankAccountService = app(BankAccountService::class);
        $user = User::find(Auth::id());
        $maxMoney = $bankAccountService->getAccountsCapacity($user) + (float)config("user.max_player_money");
        if($maxMoney - self::getAllMoney() < $money) {
            throw new AuthorizationException("You can't store this money : $money");
        }
        return true;
    }


    public static function getAllMoney() {
        $bankAccountService = app(BankAccountService::class);
        $validBankAccount = $bankAccountService->getAllValidBankAccounts(Auth::user());
        return round($validBankAccount->sum("money") + Auth::user()->playerMoney, 2);
    }

}
