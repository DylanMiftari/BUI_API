<?php

namespace App\Http\Controllers;

use App\Http\Resources\CasinoTicketResource;
use App\Models\Casino;
use App\Services\CasinoService;
use Illuminate\Support\Facades\Auth;

class CasinoController extends Controller
{
    public function __construct(
        private CasinoService $casinoService
    )
    {
    }

    public function playerTickets()
    {
        $ticket = $this->casinoService->getUserTickets(Auth::user());
        return CasinoTicketResource::collection($ticket);
    }
}
