<?php

namespace App\Http\Actions\Casino\Game;

use App\Models\BlackjackParty;
use App\Services\CasinoGame\CasinoBlackjackService;

class HitBlackjackAction
{
    public function __construct(
        private CasinoBlackjackService $casinoBlackjackService,
    )
    {
    }

    public function handle(BlackjackParty $blackjackParty): BlackjackParty {
        return $this->casinoBlackjackService->hitCard($blackjackParty);
    }
}
