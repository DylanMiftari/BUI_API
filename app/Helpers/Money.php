<?php
namespace App\Helpers;

use App\Models\User;
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
        if(!Auth::check()) {
            throw new AuthenticationException();
        }
        if(Auth::user()->playerMoney < $price) {
            throw new AuthorizationException("You don't have enough money, you need to have ".round($price, 2));
        }

        return Auth::user()->playerMoney >= $price;
    }

    /**
     * Remove money from connected user
     * @param float $price
     * @return void
     */
    public static function pay(float $price) {
        $user = User::find(Auth::id());
        $user->playerMoney = round($user->playerMoney - $price, 2);
        $user->save();
    }

    public static function creditMoney(float $money) {
        $user = User::find(Auth::id());
        $user->playerMoney = round($user->playerMoney + $money, 2);
        $user->save();
    }

    public static function canStore(float $money) {
        $user = User::find(Auth::id());
        if((float)$user->playerMoney + $money >= (float)config("user.max_player_money")) {
            throw new AuthorizationException("You can't store this money : $money");
        }
    }

}