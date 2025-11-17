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

    public function getUserTicketForCasino(User $user, Casino $casino): Model
    {
        $userTickets = $user->casinoTickets();
        $ticketsForCasino = $userTickets->where('casinoId', $casino->id);
        return $ticketsForCasino->get()->filter(function ($ticketForCasino) {
            return !$ticketForCasino->isExpired();
        })->first();
    }

    public function payCasino(Casino $casino, float $money) {
        $casino->company->moneyInSafe = round($casino->company->moneyInSafe + $money, 2);
        $casino->company->save();
    }

    public function removeMoneyFromCasino(Casino $casino, float $money): bool {
        $casino->company->moneyInSafe = round($casino->company->moneyInSafe - $money, 2);
        if($casino->company->moneyInSafe < 0) {
            $casino->company->activated = false;
        }
        $casino->company->save();

        return $casino->company->moneyInSafe < 0;
    }

}
