<?php

namespace App\Values;

class CardPack
{
    private array $cards;

    public function __construct(array $cards = []) {
        if(count($cards) === 0) {
            $this->cards = [];
            for($color = 1; $color <= 4; $color++) {
                for($value = 1; $value <= 13; $value++) {
                    $this->cards[] = new Card($color, $value);
                }
            }
            shuffle($this->cards);
        } else {
            $this->cards = $cards;
        }
    }

    public function getCards(): array {
        return $this->cards;
    }

    public function getACard(): Card {
        return array_shift($this->cards);
    }
}
