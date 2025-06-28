<?php 

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class With {

    public static function has(string $search) {
        $withArray = explode(",", request()->input("with"));

        return in_array($search, $withArray);
    }

    public static function securedHas(string $search, User $userMustBeLogged) {
        return self::has($search) && Auth::id() === $userMustBeLogged->id;
    }

    public static function add(string $withToAdd) {
        if(!self::has($withToAdd)) {
            request()->request->set("with", request()->input("with").",$withToAdd");
        }
    }

}