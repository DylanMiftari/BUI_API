<?php

namespace App\Http\Actions\Casino;

use App\Helpers\Money;
use App\Models\Casino;
use App\Models\CasinoParty;
use App\Models\User;
use App\Services\CasinoService;

class PlayGameAction
{
    public function __construct(
        protected CasinoService $casinoService,
    )
    {
    }
    public function handleBasic(User $user, Casino $casino, string $game, float $bet, float $winnings) {
        Money::pay($bet);
        $this->casinoService->payCasino($casino, $bet);
        CasinoParty::create([
            "gameName" => $game,
            "bet" => $bet,
            "winnings" => $winnings,
            "casinoId" => $casino->id,
            "userId" => $user->id,
        ]);

        if($winnings > 0) {
            Money::canStore($winnings);
            Money::creditMoney($winnings);
            $this->casinoService->removeMoneyFromCasino($casino, $winnings);
        }

        return [
            "bet" => $bet,
            "winnings" => $winnings,
        ];
    }
}
