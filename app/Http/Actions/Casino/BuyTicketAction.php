<?php

namespace App\Http\Actions\Casino;

use App\Helpers\Money;
use App\Models\Casino;
use App\Models\CasinoTicket;
use App\Models\User;
use App\Services\CasinoService;

class BuyTicketAction
{
    public function __construct(
        protected CasinoService $casinoService,
    )
    {
    }
    public function handle(User $user, Casino $casino, bool $isVIP): CasinoTicket {
        $ticketPrice = $casino->getTicketPrice($isVIP);
        Money::pay($ticketPrice, "Buy a ".($isVIP ? 'VIP' : '')." ticket for the casino".$casino->company->name);
        $this->casinoService->payCasino($casino, $ticketPrice);

        $casinoTicket = new CasinoTicket();
        $casinoTicket->isVIP = $isVIP;
        $casinoTicket->casinoId = $casino->id;
        $casinoTicket->userId = $user->id;
        $casinoTicket->save();

        return $casinoTicket;
    }
}
