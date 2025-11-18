<?php

namespace App\Http\Actions\Casino\Game;

use App\Http\Actions\Casino\PlayGameAction;
use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoGame\CasinoPokerService;
use App\Services\CasinoService;
use App\Values\Card;

class PlayPokerAction extends PlayGameAction
{
    public function __construct(
        protected CasinoService $casinoService,
        protected CasinoPokerService $casinoPokerService,
    )
    {
        parent::__construct($casinoService);
    }

    public function handle(User $user, Casino $casino, string $game, float $bet, bool $isVIP) {
        $hand = $this->casinoPokerService->getHand();
        $resHand = $this->casinoPokerService->checkHand($hand);
        $winnings = 0;

        switch ($resHand) {
            case "royalFlush":
                $winnings = $bet * ($isVIP ? $casino->royalFlushVIPMultiplicator : $casino->royalFlushMultiplicator);
                break;
            case "straightFlush":
                $winnings = $bet * ($isVIP ? $casino->straightFlushVIPMultiplicator : $casino->straightFlushMultiplicator);
                break;
            case "fourOfAKind":
                $winnings = $bet * ($isVIP ? $casino->fourOfAKindVIPMultiplicator : $casino->fourOfAKindMultiplicator);
                break;
            case "fullHouse":
                $winnings = $bet * ($isVIP ? $casino->fullHouseVIPMultiplicator : $casino->fullHouseMultiplicator);
                break;
            case "flushs":
                $winnings = $bet * ($isVIP ? $casino->flushVIPMultiplicator : $casino->flushMultiplicator);
                break;
            case "straight":
                $winnings = $bet * ($isVIP ? $casino->straightVIPMultiplicator : $casino->straightMultiplicator);
                break;
            case "threeOfAKind":
                $winnings = $bet * ($isVIP ? $casino->threeOfAKindVIPMultiplicator : $casino->threeOfAKindMultiplicator);
                break;
            case "twoPair":
                $winnings = $bet * ($isVIP ? $casino->twoPairVIPMultiplicator : $casino->twoPairMultiplicator);
                break;
            case "onePair":
                $winnings = $bet * ($isVIP ? $casino->onePairVIPMultiplicator : $casino->onePairMultiplicator);
                break;
            case "nothing":
                $winnings = $bet * ($isVIP ? $casino->nothingVIPMultiplicator : $casino->nothingMultiplicator);
                break;
        }

        $res = parent::handleBasic($user, $casino, $game, $bet, $winnings);
        $res["hand"] = $resHand;
        $res["cards"] = array_map(function($card) {
            return $card->getCardAsArray();
        }, $hand);

        return $res;
    }
}
