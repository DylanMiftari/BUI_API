<?php

namespace App\Http\Actions\Casino;

use App\Helpers\Money;
use App\Models\Casino;
use App\Models\CasinoTicket;
use App\Models\User;

class BuyTicketAction
{
    public function handle(User $user, Casino $casino, bool $isVIP): CasinoTicket {
        $ticketPrice = $casino->getTicketPrice($isVIP);
        Money::pay($ticketPrice);

        $casinoTicket = new CasinoTicket();
        $casinoTicket->isVIP = $isVIP;
        $casinoTicket->casinoId = $casino->id;
        $casinoTicket->userId = $user->id;
        $casinoTicket->save();

        return $casinoTicket;
    }
}
