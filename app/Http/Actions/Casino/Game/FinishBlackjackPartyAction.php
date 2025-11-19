<?php

namespace App\Http\Actions\Casino\Game;

use App\Http\Actions\Casino\PlayGameAction;
use App\Models\BlackjackParty;
use App\Models\Casino;
use App\Services\CasinoGame\CasinoBlackjackService;
use App\Services\CasinoService;

class FinishBlackjackPartyAction extends PlayGameAction
{
    public function __construct(
        protected CasinoService $casinoService,
        protected CasinoBlackjackService $casinoBlackjackService
    )
    {
        parent::__construct($this->casinoService);
    }

    public function handle(BlackjackParty $blackjackParty, bool $isVIP) {
        $handRes = $this->casinoBlackjackService->checkResult($blackjackParty);
        $winnings = 0;
        switch ($handRes) {
            case "push":
                $winnings = $blackjackParty->bet;
                break;
            case "blackjack":
                $winnings = $blackjackParty->bet * ($isVIP ? $blackjackParty->casino->blackJackVIPMultiplicator :
                    $blackjackParty->casino->blackJackMultiplicator);
                break;
            case "win":
                $winnings = $blackjackParty->bet * ($isVIP ? $blackjackParty->casino->blackJackVIPWinMultiplicator :
                        $blackjackParty->casino->blackJackWinMultiplicator);
                break;
        }

        $res = parent::handleBasic($blackjackParty->user, $blackjackParty->casino, "blackjack", $blackjackParty->bet, $winnings);

        $res["handRes"] = $handRes;
        $res["userHand"] = $blackjackParty->userHand;
        $res["bankHand"] = $blackjackParty->bankHand;

        $blackjackParty->delete();

        return $res;
    }
}
