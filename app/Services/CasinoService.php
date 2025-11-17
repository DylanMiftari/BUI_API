<?php

namespace App\Services;

use App\Models\Casino;
use App\Models\CasinoTicket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CasinoService
{

    public function userHasTicket(User $user, Casino $casino): bool {
        $userTickets = $user->casinoTickets();
        $ticketsForCasino = $userTickets->where('casinoId', $casino->id);
        return $ticketsForCasino->get()->filter(function ($ticketForCasino) {
            return !$ticketForCasino->isExpired();
        })->isNotEmpty();
    }

    public function getUserTickets(User $user): \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        $userTickets = $user->casinoTickets();
        return $userTickets->get()->filter(function ($ticketForCasino) {
            return !$ticketForCasino->isExpired();
        });
    }

}
