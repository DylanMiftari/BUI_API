<?php

namespace App\Policies;

use App\Enums\MafiaContractStatus;
use App\Models\MafiaContract;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MafiaContractPolicy
{
    public function updatePriceForOwner(User $user, MafiaContract $mafiaContract) {
        if($mafiaContract->robState == MafiaContractStatus::WAIT_ON_MAFIA) {
            return Response::allow();
        }
        return Response::deny("The contract is not in waiting on mafia");
    }

    public function updatePriceForClient(User $user, MafiaContract $mafiaContract) {
        if($mafiaContract->robState == MafiaContractStatus::WAIT_ON_CLIENT) {
            return Response::allow();
        }
        return Response::deny("The contract is not in waiting on client");
    }
}
