<?php

namespace App\Policies;

use App\Helpers\Money;
use App\Models\Mine;
use App\Models\MineLevel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MinePolicy
{
    public function upgrade(User $user, Mine $mine) {
        $maxLevel = MineLevel::max("level");
        if($mine->level == $maxLevel) {
            return Response::deny("Your mine is already at the max level (".$maxLevel.")");
        }
        Money::check($mine->mineLevel->priceForNextLevel);
        return Response::allow();
    }
}
