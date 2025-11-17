<?php

namespace App\Services\CasinoGame;

class CasinoRouletteService
{
    public function getRouletteRoll(): string {
        return rand(0, 9) . rand(0, 9) . rand(0, 9);
    }

    public function checkTriple7(string $roll): bool {
        return $roll === "777";
    }

    public function checkTriple(string $roll): bool {
        return in_array($roll, [
            "000", "111", "222", "333", "444", "555", "666", "888", "999"
        ]);
    }

    public function checkSequence(string $roll): bool {
        return in_array($roll, [
            "012", "123", "234", "345", "456", "567", "678", "789",
            "210", "321", "432", "543", "654", "765", "876", "987"
        ]);
    }
}
