<?php

namespace App\Services\CasinoGame;

class CasinoRoulette2Service
{
    private const RED_NUMBERS = [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36];
    private const BLACK_NUMBERS = [2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35];
    public function getTotalBet(array $bet): float {
        return array_sum(data_get($bet, "*.bet"));
    }

    public function roll(): int {
        return rand(0, 36);
    }

    public function computeWinnings(array $bet, int $roll): array {
        $res = [];
        foreach ($bet as $name=>$data) {
            if($name === "straight_up" && $this->checkStraightUp($data["number"], $roll)) {
                $res[] = "straight_up";
            } else if($name === "split" && $this->checkSplit($data["numbers"], $roll)) {
                $res[] = "split";
            } else if($name === "street" && $this->checkStreet($data["numbers"], $roll)) {
                $res[] = "street";
            } else if($name === "corner" && $this->checkCorner($data["numbers"], $roll)) {
                $res[] = "corner";
            } else if($name === "sixline" && $this->checkSixLine($data["numbers"], $roll)) {
                $res[] = "sixline";
            } else if($name === "column" && $this->checkColumn($data["column_number"], $roll)) {
                $res[] = "column";
            } else if($name === "dozen" && $this->checkDozen($data["dozen_number"], $roll)) {
                $res[] = "dozen";
            } else if($name === "odd_even" && $this->checkOddEven($data["bet_name"], $roll)) {
                $res[] = "odd_even";
            } else if($name === "red_black" && $this->checkRedBlack($data["bet_name"], $roll)) {
                $res[] = "red_black";
            } else if($name === "middle" && $this->checkMiddle($data["part_number"], $roll)) {
                $res[] = "middle";
            }
        }

        return $res;
    }

    public function checkStraightUp(int $number, int $roll): bool {
        return $number === $roll;
    }

    public function checkSplit(array $numbers, int $roll): bool {
        return in_array($roll, $numbers);
    }

    public function checkStreet(array $numbers, int $roll): bool {
        return in_array($roll, $numbers);
    }

    public function checkCorner(array $numbers, int $roll): bool {
        return in_array($roll, $numbers);
    }

    public function checkSixLine(array $numbers, int $roll): bool {
        return in_array($roll, $numbers);
    }

    public function checkColumn(int $columnNumber, int $roll): bool {
        if($columnNumber === 0) {
            return $roll % 3 === 1;
        } else if($columnNumber === 1) {
            return $roll % 3 === 2;
        } else {
            return $roll % 3 === 0;
        }
    }

    public function checkDozen(int $dozenNumber, int $roll): bool {
        if($dozenNumber === 0) {
            return 1 <= $roll && $roll <= 12;
        } else if($dozenNumber === 1) {
            return 13 <= $roll && $roll <= 24;
        } else {
            return $roll >= 25;
        }
    }

    public function checkOddEven(string $bet, int $roll): bool {
        if($bet === "even") {
            return $roll % 2 === 0;
        }
        return $roll % 2 === 1;
    }

    public function checkRedBlack(string $bet, int $roll): bool {
        if($bet === "red") {
            return in_array($roll, self::RED_NUMBERS);
        }
        return in_array($roll, self::BLACK_NUMBERS);
    }

    public function checkMiddle(int $partNumber, int $roll): bool {
        if($partNumber === 0) {
            return $roll <= 18 && $roll >= 1;
        }
        return $roll > 18;
    }
}
