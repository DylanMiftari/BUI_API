<?php

namespace App\Http\Controllers;

use App\Http\Actions\Casino\BuyTicketAction;
use App\Http\Actions\Casino\Game\CreateBlackjackPartyAction;
use App\Http\Actions\Casino\Game\FinishBlackjackPartyAction;
use App\Http\Actions\Casino\Game\HitBlackjackAction;
use App\Http\Actions\Casino\Game\PlayDiceAction;
use App\Http\Actions\Casino\Game\PlayPokerAction;
use App\Http\Actions\Casino\Game\PlayRouletteAction;
use App\Http\Requests\Casino\BasicGameRequest;
use App\Http\Requests\Casino\BuyTicketRequest;
use App\Http\Resources\BlackjackPartyResource;
use App\Http\Resources\CasinoTicketResource;
use App\Models\BlackjackParty;
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

    public function playDice(BasicGameRequest $request, Casino $casino, PlayDiceAction $action)
    {
        request()->attributes->add(["game" => "dice"]);
        $this->authorize("playGame", $casino);

        $res = $action->handle(Auth::user(), $casino, "dice", $request->input("bet"),
            request()->attributes->get('isVIP'));

        return $res;
    }

    public function playPoker(BasicGameRequest $request, Casino $casino, PlayPOkerAction $action)
    {
        request()->attributes->add(["game" => "poker"]);
        $this->authorize("playGame", $casino);

        $res = $action->handle(Auth::user(), $casino, "poker", $request->input("bet"),
            request()->attributes->get('isVIP'));

        return $res;
    }

    public function initBlackjack(BasicGameRequest $request, Casino $casino, CreateBlackjackPartyAction $action)
    {
        request()->attributes->add(["game" => "blackjack"]);
        $this->authorize("playGame", $casino);

        $blackjackParty = Auth::user()->blackjackPartyForCasino($casino);
        if($blackjackParty == null){
            $blackjackParty = $action->handle(Auth::user(), $casino, $request->input("bet"));
        }

        return new BlackjackPartyResource($blackjackParty);
    }

    public function hitBlackjack(Casino $casino, BlackjackParty $blackjack_party, HitBlackjackAction $action)
    {
        $this->authorize("finishBlackjack", $casino);
        $blackjackParty = $action->handle($blackjack_party);

        return new BlackjackPartyResource($blackjackParty);
    }

    public function finishBlackjack(Casino $casino, BlackjackParty $blackjack_party, FinishBlackjackPartyAction $action)
    {
        $this->authorize("finishBlackjack", $casino);

        $ticket = $this->casinoService->getUserTicketForCasino(Auth::user(), $casino);
        $isVIP = $ticket->isVIP;

        $res = $action->handle($blackjack_party, $isVIP);
        return $res;
    }

}
