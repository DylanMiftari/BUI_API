<?php

namespace App\Http\Actions\Casino;

use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoGame\CasinoRouletteService;
use App\Services\CasinoService;

class PlayRouletteAction extends PlayGameAction
{
    public function __construct(
        protected CasinoService $casinoService,
        private CasinoRouletteService $casinoRouletteService
    )
    {
        parent::__construct($casinoService);
    }

    public function handle(User $user, Casino $casino, string $game, float $bet, bool $isVIP) {
        $roll = $this->casinoRouletteService->getRouletteRoll();
        $winnings = 0;
        if($this->casinoRouletteService->checkTriple7($roll)) {
            $winnings = ($isVIP ? $casino->rouletteVIPTripleSeventMultiplicator : $casino->rouletteTripleSeventMultiplicator) * $bet;
        } else if($this->casinoRouletteService->checkTriple($roll)) {
            $winnings = ($isVIP ? $casino->rouletteVIPTripletMultiplcator : $casino->rouletteTripletMultiplcator) * $bet;
        } else if($this->casinoRouletteService->checkSequence($roll)) {
            $winnings = ($isVIP ? $casino->rouletteVIPSequenceMultiplicator : $casino->rouletteSequenceMultiplicator) * $bet;
        }

        $res = parent::handleBasic($user, $casino, $game, $bet, $winnings);
        $res["roll"] = $roll;

        return $res;
    }
}
