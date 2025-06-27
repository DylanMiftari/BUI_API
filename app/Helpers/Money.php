<?php
namespace App\Helpers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class Money {

    public static function check(float $price) {
        if(!Auth::check()) {
            throw new AuthenticationException();
        }
        if(Auth::user()->playerMoney < $price) {
            throw new AuthorizationException("You don't have enough money, you need to have ".round($price, 2));
        }

        return Auth::user()->playerMoney >= $price;
    }

}