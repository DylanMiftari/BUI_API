<?php

namespace App\Http\Actions\Casino\Game;

use App\Http\Actions\Casino\PlayGameAction;
use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoGame\CasinoDiceService;
use App\Services\CasinoService;

class PlayDiceAction extends PlayGameAction
{
    public function __construct(
        protected CasinoService $casinoService,
        protected CasinoDiceService $casinoDiceService,
    )
    {
        parent::__construct($casinoService);
    }

    public function handle(User $user, Casino $casino, string $game, float $bet, bool $isVIP) {
        $roll = $this->casinoDiceService->roll();
        $winnings = 0;
        if($this->casinoDiceService->checkRollIsGoal($roll, $casino, $isVIP)) {
            $winnings = $bet * ($isVIP ? $casino->diceVIPWinMultiplicator : $casino->diceWinMultiplicator);
        }

        $res = parent::handleBasic($user, $casino, $game, $bet, $winnings);
        $res["roll"] = $roll;
        $res["sum"] = array_sum($roll);

        return $res;
    }
}
