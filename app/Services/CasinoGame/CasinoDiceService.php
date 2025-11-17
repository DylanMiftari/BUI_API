<?php

namespace App\Services\CasinoGame;

use App\Models\Casino;

class CasinoDiceService
{
    public function roll(): array {
        return [
            rand(1, 6),
            rand(1, 6),
        ];
    }

    public function diceGoal(Casino $casino, bool $isVIP) {
        return $isVIP ? $casino->diceVIPGoal : $casino->diceGoal;
    }

    public function checkRollIsGoal(array $roll, Casino $casino, bool $isVIP): bool {
        return array_sum($roll) == $this->diceGoal($casino, $isVIP);
    }
}
