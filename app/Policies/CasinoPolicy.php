<?php

namespace App\Policies;

use App\Helpers\Money;
use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoService;
use Illuminate\Auth\Access\Response;

class CasinoPolicy
{
    public function __construct(private CasinoService $casinoService)
    {
    }

    public function buyTicket(User $user, Casino $casino) {
        Money::check($casino->getTicketPrice(request()->input("isVIP", true)));
        if($this->casinoService->userHasTicket($user, $casino)) {
            return Response::deny("You already have a ticket");
        }
        return Response::allow();
    }

    public function playGame(User $user, Casino $casino) {
        $bet = request()->input("bet");
        Money::check($bet);

        $ticket = $this->casinoService->getUserTicketForCasino($user, $casino);
        $isVIP = $ticket->isVIP;
        $game = request()->attributes->get('game');
        request()->attributes->set('isVIP', $isVIP);

        if($bet > $casino->getMaxBetForGame($game, $isVIP)) {
            return Response::deny("You can't play more than $bet");
        }

        return Response::allow();
    }
}
