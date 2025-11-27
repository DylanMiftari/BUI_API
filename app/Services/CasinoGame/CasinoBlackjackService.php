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

    public function checkResult(BlackjackParty $blackjackParty) {
        $this->completBankHand($blackjackParty);
        $userHand = array_map(fn($card) => Card::createFromArray($card), $blackjackParty->userHand);
        $bankHand = array_map(fn($card) => Card::createFromArray($card), $blackjackParty->bankHand);

        $userSum = $this->getTotalOfHand($userHand);
        $bankSum = $this->getTotalOfHand($bankHand);

        if($userSum > 21) {
            return "bust";
        }
        if($this->checkBlackjack($userHand)) {
            return $this->checkBlackjack($bankHand) ? "push" : "blackjack";
        }
        if($userSum > $bankSum || $bankSum > 21) {
            return "win";
        }
        if($userSum == $bankSum) {
            return "push";
        }
        if($userHand < $bankHand) {
            return "lose";
        }
        return "lose";
    }

    private function completBankHand(BlackjackParty $blackjackParty): BlackjackParty {
        $cardPack = new CardPack(
            array_map(fn($card) => Card::createFromArray($card), $blackjackParty->cardPack)
        );
        $bankHand = array_map(fn($card) => Card::createFromArray($card), $blackjackParty->bankHand);

        while($this->getTotalOfHand($bankHand) <= 16) {
            $bankHand[] = $cardPack->getACard();
        }
        $blackjackParty->bankHand = array_map(fn($card) => $card->getCardAsArray(), $bankHand);
        $blackjackParty->save();

        return $blackjackParty;
    }

    private function checkBlackjack(array $cards) {
        return $this->getTotalOfHand($cards) === 21 && count($cards) === 2;
    }

    private function getTotalOfHand(array $hand) {
        $sumWithAce1 = array_reduce($hand, function($carry, $item) {
            return min($item->getValue(), 10) + $carry;
        }, 0);
        $sumWithAce11 = array_reduce($hand, function($carry, $item) {
            return ($item->getValue() === 1 ? 11 : min($item->getValue(), 10)) + $carry;
        }, 0);

        if($sumWithAce1 > 21) {
            return $sumWithAce1;
        }
        return max($sumWithAce11, $sumWithAce1);
    }
}
