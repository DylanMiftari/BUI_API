<?php

namespace App\Http\Controllers;

use App\Http\Actions\Casino\BuyTicketAction;
use App\Http\Actions\Casino\PlayRouletteAction;
use App\Http\Requests\Casino\BasicGameRequest;
use App\Http\Requests\Casino\BuyTicketRequest;
use App\Http\Resources\CasinoTicketResource;
use App\Models\Casino;
use App\Services\CasinoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CasinoController extends Controller
{
    use AuthorizesRequests;
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

    public function buyTicket(BuyTicketRequest $request, Casino $casino, BuyTicketAction $action)
    {
        $this->authorize('buyTicket', $casino);

        $ticket = $action->handle(Auth::user(), $casino, $request->input("isVIP"));

        return new CasinoTicketResource($ticket);
    }

    public function playRoulette(BasicGameRequest $request, Casino $casino, PlayRouletteAction $action)
    {
        request()->attributes->add(["game" => "roulette"]);

        $this->authorize("playGame", $casino);

        $res = $action->handle(Auth::user(), $casino, "roulette", $request->input("bet"),
            request()->attributes->get('isVIP'));

        return $res;
    }
}
