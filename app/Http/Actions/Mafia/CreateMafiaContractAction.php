<?php

namespace App\Http\Actions\Mafia;

use App\Enums\MafiaContractStatus;
use App\Enums\MafiaTargetType;
use App\Models\Mafia;
use App\Models\MafiaContract;
use App\Models\User;

class CreateMafiaContractAction
{
    public function handle(Mafia $mafia, User $user, MafiaTargetType $targetType, int $targetId): MafiaContract
    {
        return MafiaContract::create([
            "clientPrice" => -1,
            "robState" => MafiaContractStatus::WAIT_ON_MAFIA,
            "userId" => $user->id,
            "mafiaId" => $mafia->id,
            "targetType" => $targetType,
            "targetId" => $targetId,
        ]);
    }
}
