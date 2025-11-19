<?php

namespace App\Http\Actions\Casino\Game;

use App\Models\BlackjackParty;
use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoGame\CasinoBlackjackService;

class CreateBlackjackPartyAction
{
    public function __construct(
        protected CasinoBlackjackService $blackjackService,
    )
    {
    }

    public function handle(User $user, Casino $casino, float $bet): BlackjackParty {
        $roll = $this->blackjackService->roll();

        $blackjackParty = new BlackjackParty();
        $blackjackParty->casinoId = $casino->id;
        $blackjackParty->userId = $user->id;
        $blackjackParty->userHand = array_map(fn ($card) => $card->getCardAsArray(), $roll["userHand"]);
        $blackjackParty->bankHand = array_map(fn ($card) => $card->getCardAsArray(), $roll["bankHand"]);
        $blackjackParty->bet = $bet;
        $blackjackParty->cardPack = array_map(fn ($card) => $card->getCardAsArray(), $roll["cardPack"]);
        $blackjackParty->save();

        return $blackjackParty;
    }
}
