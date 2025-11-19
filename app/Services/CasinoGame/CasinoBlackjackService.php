<?php

namespace App\Services\CasinoGame;

use App\Models\BlackjackParty;
use App\Values\Card;
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

    public function hitCard(BlackjackParty $blackjackParty): BlackjackParty {
        $cardPack = new CardPack(
            array_map(fn($card) => Card::createFromArray($card), $blackjackParty->cardPack)
        );
        $newUserCard = $cardPack->getACard();
        $newUserHand = array_merge($blackjackParty->userHand, [$newUserCard->getCardAsArray()]);

        $blackjackParty->userHand = $newUserHand;
        $blackjackParty->cardPack = array_map(
            fn($card) => is_array($card) ? $card : $card->getCardAsArray(),
            $cardPack->getCards()
        );

        $blackjackParty->save();
        return $blackjackParty;
    }
}
