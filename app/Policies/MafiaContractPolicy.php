<?php

namespace App\Policies;

use App\Enums\MafiaContractStatus;
use App\Helpers\Money;
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

    public function acceptContract(User $user, MafiaContract $contract) {
        if($contract->robState != MafiaContractStatus::WAIT_ON_CLIENT) {
            return Response::deny("The contract is not in waiting on client");
        }
        if($contract->clientPrice == -1) {
            return Response::deny("The contract has not determined price");
        }
        Money::check($contract->clientPrice);
        return Response::allow();
    }

    public function claimContract(User $user, MafiaContract $contract) {
        if($contract->robState != MafiaContractStatus::ROBED) {
            return Response::deny("The robbery has not yet taken place");
        }
        if($contract->robWinnings > $contract->mafia->company->moneyInSafe) {
            return Response::deny("The mafia has not enough money to pay you");
        }
        Money::canStore($contract->robWinnings);
        return Response::allow();
    }

    public function rob(User $user, MafiaContract $mafiaContract) {
        if($mafiaContract->robState == MafiaContractStatus::ROBED) {
            return Response::deny("The target has already been robed");
        }
        if($mafiaContract->robState != MafiaContractStatus::PAYED) {
            return Response::deny("The contract is not payed, wait the client payment");
        }
        return Response::allow();
    }
}
