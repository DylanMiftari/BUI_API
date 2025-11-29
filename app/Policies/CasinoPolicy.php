<?php

namespace App\Policies;

use App\Helpers\Money;
use App\Models\BlackjackParty;
use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoGame\CasinoRoulette2Service;
use App\Services\CasinoGame\CasinoRouletteService;
use App\Services\CasinoService;
use Illuminate\Auth\Access\Response;

class CasinoPolicy
{
    public function __construct(
        private CasinoService $casinoService,
        private CasinoRoulette2Service $casinoRoulette2Service
    ) {
    }

    public function buyTicket(User $user, Casino $casino)
    {
        Money::check($casino->getTicketPrice(request()->input("isVIP", true)));
        if ($this->casinoService->userHasTicket($user, $casino)) {
            return Response::deny("You already have a ticket");
        }
        return Response::allow();
    }

    public function playGame(User $user, Casino $casino)
    {
        $bet = request()->input("bet");
        $game = request()->attributes->get('game');
        if ($game === "roulette2") {
            $bet = $this->casinoRoulette2Service->getTotalBet($bet);
        }
        Money::check($bet);

        $ticket = $this->casinoService->getUserTicketForCasino($user, $casino);
        $isVIP = $ticket->isVIP;
        request()->attributes->set('isVIP', $isVIP);

        if ($bet > $casino->getMaxBetForGame($game, $isVIP)) {
            return Response::deny("You can't play more than $bet");
        }

        return Response::allow();
    }

    public function finishBlackjack(User $user, Casino $casino)
    {
        $blackjackParty = BlackjackParty::where("userId", $user->id)
            ->where("casinoId", $casino->id)->first();

        Money::check($blackjackParty->bet);

        return Response::allow();
    }
}
