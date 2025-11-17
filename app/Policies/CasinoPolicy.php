<?php

namespace App\Policies;

use App\Helpers\Money;
use App\Models\Casino;
use App\Models\User;
use App\Services\CasinoService;
use Illuminate\Auth\Access\Response;

class CasinoPolicy
{
    public function __construct(private CasinoService $casinoService)
    {
    }

    public function buyTicket(User $user, Casino $casino) {
        Money::check($casino->getTicketPrice(request()->input("isVIP", true)));
        if($this->casinoService->userHasTicket($user, $casino)) {
            return Response::deny("You already have a ticket");
        }
        return Response::allow();
    }
}
