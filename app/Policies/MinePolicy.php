<?php

namespace App\Policies;

use App\Helpers\Money;
use App\Helpers\Resource;
use App\Models\Mine;
use App\Models\MineLevel;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Carbon;

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

    public function collect(User $user, Mine $mine) {
        $now = Carbon::now();
        $expectedEnd = $mine->startedAt->addMinutes($mine->resource->timeToMine);
        if($now->isBefore($expectedEnd)) {
            return Response::deny("Your mine didn't finish the process");
        }
        if(!Resource::canStore($mine->resource->mineQuantity)) {
            return Response::deny("You can't store resources from the mine");
        }
        return Response::allow();
    }
}
