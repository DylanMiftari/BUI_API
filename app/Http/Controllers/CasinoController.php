<?php

namespace App\Http\Controllers;

use App\Helpers\With;
use App\Http\Actions\Casino\BuyTicketAction;
use App\Http\Actions\Casino\Game\CreateBlackjackPartyAction;
use App\Http\Actions\Casino\Game\FinishBlackjackPartyAction;
use App\Http\Actions\Casino\Game\HitBlackjackAction;
use App\Http\Actions\Casino\Game\PlayDiceAction;
use App\Http\Actions\Casino\Game\PlayPokerAction;
use App\Http\Actions\Casino\GetCasinoDashboardAction;
use App\Http\Actions\Casino\Game\PlayRoulette2Action;
use App\Http\Actions\Casino\Game\PlayRouletteAction;
use App\Http\Requests\Casino\BasicGameRequest;
use App\Http\Requests\Casino\BuyTicketRequest;
use App\Http\Requests\Casino\PlayRoulette2Request;
use App\Http\Requests\Casino\UpdateDiceRequest;
use App\Http\Requests\Casino\UpdateRouletteRequest;
use App\Http\Requests\Casino\UpdateTicketPriceRequest;
use App\Http\Resources\BlackjackPartyResource;
use App\Http\Resources\CasinoDashboardResource;
use App\Http\Resources\CasinoResource;
use App\Http\Resources\CasinoTicketResource;
use App\Models\BlackjackParty;
use App\Models\Casino;
use App\Services\CasinoGame\CasinoRoulette2Service;
use App\Services\CasinoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CasinoController extends Controller
{
    use AuthorizesRequests;
    public function __construct(
        private CasinoService $casinoService
    ) {
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

        $res = $action->handle(
            Auth::user(),
            $casino,
            "roulette",
            $request->input("bet"),
            request()->attributes->get('isVIP')
        );

        return $res;
    }

    public function playDice(BasicGameRequest $request, Casino $casino, PlayDiceAction $action)
    {
        request()->attributes->add(["game" => "dice"]);
        $this->authorize("playGame", $casino);

        $res = $action->handle(
            Auth::user(),
            $casino,
            "dice",
            $request->input("bet"),
            request()->attributes->get('isVIP')
        );

        return $res;
    }

    public function playPoker(BasicGameRequest $request, Casino $casino, PlayPOkerAction $action)
    {
        request()->attributes->add(["game" => "poker"]);
        $this->authorize("playGame", $casino);

        $res = $action->handle(
            Auth::user(),
            $casino,
            "poker",
            $request->input("bet"),
            request()->attributes->get('isVIP')
        );

        return $res;
    }

    public function initBlackjack(BasicGameRequest $request, Casino $casino, CreateBlackjackPartyAction $action)
    {
        request()->attributes->add(["game" => "blackjack"]);
        $this->authorize("playGame", $casino);

        $blackjackParty = Auth::user()->blackjackPartyForCasino($casino);
        if ($blackjackParty == null) {
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

    public function playRoulette2(PlayRoulette2Request $request, Casino $casino, PlayRoulette2Action $action)
    {
        request()->attributes->add(["game" => "roulette2"]);
        $this->authorize("playGame", $casino);

        $res = $action->handle(
            Auth::user(),
            $casino,
            "roulette2",
            $request->input("bet"),
            request()->attributes->get('isVIP')
        );

        return $res;
    }

    public function showCasino(Casino $casino)
    {
        With::add("casino-dashboard");
        return new CasinoResource($casino);
    }

    public function hasTicket(Casino $casino)
    {
        return [];
    }

    public function showTicket(Casino $casino)
    {
        $ticket = $this->casinoService->getUserTicketForCasino(Auth::user(), $casino);
        With::add("max-bet");

        return new CasinoTicketResource($ticket);
    }

    public function getRouletteData(Casino $casino)
    {
        return [
            "sequenceMultiplicator" => $casino->rouletteSequenceMultiplicator,
            "tripletMultiplicator" => $casino->rouletteTripletMultiplcator,
            "tripleSevenMultiplicator" => $casino->rouletteTripleSeventMultiplicator,
            "sequenceVIPMultiplicator" => $casino->rouletteVIPSequenceMultiplicator,
            "tripletVIPMultiplicator" => $casino->rouletteVIPTripletMultiplcator,
            "tripleSevenVIPMultiplicator" => $casino->rouletteVIPTripleSeventMultiplicator,
            "maxBet" => $casino->rouletteMaxBet,
            "maxVIPBet" => $casino->rouletteMaxVIPBet,
        ];
    }

    public function getDiceData(Casino $casino)
    {
        return [
            "goal" => $casino->diceGoal,
            "winMultiplicator" => $casino->diceWinMultiplicator,
            "maxBet" => $casino->diceMaxBet,
            "vipGoal" => $casino->diceVIPGoal,
            "vipWinMultiplicator" => $casino->diceVIPWinMultiplicator,
            "vipMaxBet" => $casino->diceVIPMaxBet,
        ];
    }

    public function getPokerData(Casino $casino)
    {
        return [
            "nothingMultiplicator" => $casino->nothingMultiplicator,
            "onePairMultiplicator" => $casino->onePairMultiplicator,
            "twoPairMultiplicator" => $casino->twoPairMultiplicator,
            "threeOfAKindMultiplicator" => $casino->threeOfAKindMultiplicator,
            "straightMultiplicator" => $casino->straightMultiplicator,
            "flushMultiplicator" => $casino->flushMultiplicator,
            "fullHouseMultiplicator" => $casino->fullHouseMultiplicator,
            "fourOfAKindMultiplicator" => $casino->fourOfAKindMultiplicator,
            "straightFlushMultiplicator" => $casino->straightFlushMultiplicator,
            "royalFlushMultiplicator" => $casino->royalFlushMultiplicator,
            "maxBet" => $casino->pokerMaxBet,
            "nothingVIPMultiplicator" => $casino->nothingVIPMultiplicator,
            "onePairVIPMultiplicator" => $casino->onePairVIPMultiplicator,
            "twoPairVIPMultiplicator" => $casino->twoPairVIPMultiplicator,
            "threeOfAKindVIPMultiplicator" => $casino->threeOfAKindVIPMultiplicator,
            "straightVIPMultiplicator" => $casino->straightVIPMultiplicator,
            "flushVIPMultiplicator" => $casino->flushVIPMultiplicator,
            "fullHouseVIPMultiplicator" => $casino->fullHouseVIPMultiplicator,
            "fourOfAKindVIPMultiplicator" => $casino->fourOfAKindVIPMultiplicator,
            "straightFlushVIPMultiplicator" => $casino->straightFlushVIPMultiplicator,
            "royalFlushVIPMultiplicator" => $casino->royalFlushVIPMultiplicator,
            "maxVIPBet" => $casino->pokerMaxVIPBet,
        ];
    }

    public function getBlackjackData(Casino $casino)
    {
        return [
            "winMultiplicator" => $casino->blackJackWinMultiplicator,
            "blackjackMultiplicator" => $casino->blackJackMultiplicator,
            "maxBet" => $casino->blackJackMaxBet,
            "vipWinMultiplicator" => $casino->blackJackVIPWinMultiplicator,
            "vipBlackjackMultiplicator" => $casino->blackJackVIPMultiplicator,
            "vipMaxBet" => $casino->blackJackVIPMaxBet,
        ];
    }

    public function getRoulette2Data(Casino $casino)
    {
        return [
            "straightUpMultiplicator" => $casino->roulette2StraigthUpMultiplicator,
            "splitMultiplicator" => $casino->roulette2SplitMultiplicator,
            "streetMultiplicator" => $casino->roulette2treetMultiplicator,
            "cornerMultiplicator" => $casino->roulette2CornerMultiplicator,
            "sixLineMultiplicator" => $casino->roulette2SixLineMultiplicator,
            "columnMultiplicator" => $casino->roulette2ColumnMultiplicator,
            "dozenMultiplicator" => $casino->roulette2DozenMultiplicator,
            "oddEvenMultiplicator" => $casino->roulette2OddEvenMultiplicator,
            "redBlackMultiplicator" => $casino->roulette2RedBlackMultiplicator,
            "middleMultiplicator" => $casino->roulette2MiddleMultiplicator,
            "maxBet" => $casino->roulette2MaxBet,
            "vipStraightUpMultiplicator" => $casino->roulette2VIPStraigthUpMultiplicator,
            "vipSplitMultiplicator" => $casino->roulette2VIPSplitMultiplicator,
            "vipStreetMultiplicator" => $casino->roulette2VIPtreetMultiplicator,
            "vipCornerMultiplicator" => $casino->roulette2VIPCornerMultiplicator,
            "vipSixLineMultiplicator" => $casino->roulette2VIPSixLineMultiplicator,
            "vipColumnMultiplicator" => $casino->roulette2VIPColumnMultiplicator,
            "vipDozenMultiplicator" => $casino->roulette2VIPDozenMultiplicator,
            "vipOddEvenMultiplicator" => $casino->roulette2VIPOddEvenMultiplicator,
            "vipRedBlackMultiplicator" => $casino->roulette2VIPRedBlackMultiplicator,
            "vipMiddleMultiplicator" => $casino->roulette2VIPMiddleMultiplicator,
            "vipMaxBet" => $casino->roulette2VIPMaxBet,
        ];
    }

    public function getDashboard(Casino $casino, GetCasinoDashboardAction $action)
    {
        $res = $action->handle($casino);

        return new CasinoDashboardResource($res);
    }

    public function updateTicketPrice(UpdateTicketPriceRequest $request, Casino $casino)
    {
        $casino->update($request->validated());

        return response()->noContent();
    }

    public function updateRoulette(UpdateRouletteRequest $request, Casino $casino)
    {
        $casino->update($request->validated());

        return response()->noContent();
    }

    public function updateDice(UpdateDiceRequest $request, Casino $casino)
    {
        $casino->update($request->validated());

        return response()->noContent();
    }

}
