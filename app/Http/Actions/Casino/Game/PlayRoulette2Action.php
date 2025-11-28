<?php

namespace App\Http\Actions\Casino\Game;

use App\Http\Actions\Casino\PlayGameAction;
use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoGame\CasinoRoulette2Service;
use App\Services\CasinoService;

class PlayRoulette2Action extends PlayGameAction
{
    public function __construct(
        protected CasinoService $casinoService,
        protected CasinoRoulette2Service $casinoRoulette2Service
    ) {
        parent::__construct($casinoService);
    }

    public function handle(User $user, Casino $casino, string $game, array $bet, bool $isVIP)
    {
        $totalBet = $this->casinoRoulette2Service->getTotalBet($bet);
        $roll = $this->casinoRoulette2Service->roll();
        $goodBets = $this->casinoRoulette2Service->computeWinnings($bet, $roll);

        $winnings = 0;
        foreach ($goodBets as $betName => $winningBetAmount) {
            switch ($betName) {
                case "straight_up":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPStraigthUpMultiplicator : $casino->roulette2StraigthUpMultiplicator);
                    break;
                case "split":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPSplitMultiplicator : $casino->roulette2SplitMultiplicator);
                    break;
                case "street":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPtreetMultiplicator : $casino->roulette2treetMultiplicator);
                    break;
                case "corner":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPCornerMultiplicator : $casino->roulette2CornerMultiplicator);
                    break;
                case "sixline":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPSixLineMultiplicator : $casino->roulette2SixLineMultiplicator);
                    break;
                case "column":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPColumnMultiplicator : $casino->roulette2ColumnMultiplicator);
                    break;
                case "dozen":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPDozenMultiplicator : $casino->roulette2DozenMultiplicator);
                    break;
                case "odd_even":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPOddEvenMultiplicator : $casino->roulette2OddEvenMultiplicator);
                    break;
                case "red_black":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPRedBlackMultiplicator : $casino->roulette2RedBlackMultiplicator);
                    break;
                case "middle":
                    $winnings += $winningBetAmount * ($isVIP ? $casino->roulette2VIPMiddleMultiplicator : $casino->roulette2MiddleMultiplicator);
                    break;
            }
        }

        $res = parent::handleBasic($user, $casino, $game, $totalBet, $winnings);

        $res["res"] = $goodBets;
        $res["roll"] = $roll;

        return $res;
    }
}
