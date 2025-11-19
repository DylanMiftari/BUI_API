<?php

namespace App\Services\CasinoGame;

use App\Values\CardPack;

class CasinoBlackjackService
{
    public function roll(): array {
        $cardPack = new CardPack();
        return [
            "userHand" => [
                $cardPack->getACard(),
                $cardPack->getACard()
            ],
            "bankHand" => [
                $cardPack->getACard(),
                $cardPack->getACard()
            ],
            "cardPack" => $cardPack->getCards(),
        ];
    }
}
