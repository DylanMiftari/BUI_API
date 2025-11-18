<?php

namespace App\Services\CasinoGame;

use App\Values\CardPack;
use Illuminate\Support\Arr;

class CasinoPokerService
{
    public function getHand(): array {
        $cardPack = new CardPack();
        return [
            $cardPack->getACard(),
            $cardPack->getACard(),
            $cardPack->getACard(),
            $cardPack->getACard(),
            $cardPack->getACard()
        ];
    }

    public function checkHand(array $hand): string {
        if($this->checkRoyalFlush($hand)) {
            return "royalFlush";
        }
        if($this->checkStraightFlush($hand)) {
            return "straightFlush";
        }
        if($this->checkFourOfAKind($hand)) {
            return "fourOfAKind";
        }
        if($this->checkFullHouse($hand)) {
            return "fullHouse";
        }
        if($this->checkFlush($hand)) {
            return "flush";
        }
        if($this->checkStraight($hand)) {
            return "straight";
        }
        if($this->checkThreeOfAKind($hand)) {
            return "threeOfAKind";
        }
        if($this->checkTwoPair($hand)) {
            return "twoPair";
        }
        if($this->checkOnePair($hand)) {
            return "onePair";
        }
        return "nothing";
    }

    private function checkRoyalFlush(array $hand): bool {
        $sortedHand = $this->sortHandByValue($hand);
        return $sortedHand[0]->getValue() === 1 &&
            $sortedHand[1]->getValue() === 10 &&
            $sortedHand[2]->getValue() === 11 &&
            $sortedHand[3]->getValue() === 12 &&
            $sortedHand[4]->getValue() === 13 &&
            $this->checkFlush($sortedHand);
    }

    private function checkStraightFlush(array $hand): bool {
        return $this->checkStraight($hand) && $this->checkFlush($hand);
    }

    private function checkFourOfAKind(array $hand): bool {
        foreach ($hand as $card) {
            if($this->getNumberOfValue($hand, $card->getValue()) === 4) {
                return true;
            }
        }
        return false;
    }

    private function checkFullHouse(array $hand): bool {
        return $this->checkThreeOfAKind($hand) && $this->checkOnePair($hand);
    }

    private function checkStraight(array $hand): bool {
        $sortedHand = $this->sortHandByValue($hand);
        $lastValue = $sortedHand[0]->getValue();
        $firstIsAce = $lastValue === 1;
        foreach (array_slice($sortedHand, 1) as $card) {
            if(
                $card->getValue() !== $lastValue+1 &&
                !($card->getValue() === 10 && $firstIsAce)
            ) {
                return false;
            }
            $lastValue = $card->getValue();
        }
        return true;
    }

    private function checkFlush(array $hand): bool {
        $color = $hand[0]->getColor();
        foreach ($hand as $card) {
            if($card->getColor() !== $color) {
                return false;
            }
        }
        return true;
    }

    private function checkThreeOfAKind(array $hand): bool {
        foreach ($hand as $card) {
            if($this->getNumberOfValue($hand, $card->getValue()) === 3) {
                return true;
            }
        }
        return false;
    }

    private function checkTwoPair(array $hand): bool {
        $pair1 = 0;
        $pair2 = 0;
        foreach ($hand as $card) {
            if($this->getNumberOfValue($hand, $card->getValue()) === 2) {
                if($pair1 === 0) {
                    $pair1 = $card->getValue();
                } else if($card->getValue() !== $pair1) {
                    $pair2 = $card->getValue();
                }
            }
        }
        return $pair1 !== 0 && $pair2 !== 0;
    }

    private function checkOnePair(array $hand): bool {
        foreach ($hand as $card) {
            if($this->getNumberOfValue($hand, $card->getValue()) === 2) {
                return true;
            }
        }
        return false;
    }

    private function sortHandByValue(array $hand): array {
        return array_values(Arr::sort($hand, function ($card) {
            return $card->getValue();
        }));
    }

    private function getNumberOfValue(array $hand, int $value): int {
        $count = 0;
        foreach ($hand as $card) {
            if($card->getValue() === $value) {
                $count++;
            }
        }
        return $count;
    }
}
