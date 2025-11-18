<?php

namespace App\Values;

class Card
{
    private int $color;
    private int $value;

    public function __construct(int $color, int $value) {
        $this->color = $color;
        $this->value = $value;
    }

    public function getColor(): int {
        return $this->color;
    }

    public function getValue(): int {
        return $this->value;
    }

    public function getCardAsArray(): array {
        return [
            "color" => $this->color,
            "value" => $this->value
        ];
    }
}
