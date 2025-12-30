<?php

namespace App\Http\Actions\Mafia;

use App\Models\Mafia;
use App\Models\MafiaContract;
use App\Models\User;

class GetMafiaContractFromClient
{
    public function handle(Mafia $mafia, User $user): MafiaContract|null {
        return MafiaContract::where("userId", $user->id)
            ->where("mafiaId", $mafia->id)
            ->first();
    }
}
