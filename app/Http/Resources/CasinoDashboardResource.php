<?php

namespace App\Http\Resources;

use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CasinoDashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $casino = $this["casino"];
        $nextLevelPrice = $this["nextLevelPrice"];
        $levels = $this["levels"];

        return [
            "info" => [
                "id" => $casino->id,
                "name" => $casino->company->name,
                "level" => $casino->level,
                "moneyInSafe" => $casino->company->moneyInSafe,
                "ticketsSold" => $casino->getActiveTicketsCount(),
                "vipTicketsSold" => $casino->getActiveVIPTicketsCount(),
                "maxTickets" => $casino->casinoLevel->nbMaxTicket,
                "maxVipTickets" => $casino->casinoLevel->nbMaxVIPTicket,
                "companyId" => $casino->company->id,
            ],
            "nextLevelPrice" => $nextLevelPrice,
            "levels" => $levels,
            $this->mergeWhen(With::has("config"), [
                "config" => [
                    "ticketPrice" => $casino->ticketPrice,
                    "vipTicketPrice" => $casino->VIPTicketPrice,
                    "rouletteSequenceMultiplicator" => $casino->rouletteSequenceMultiplicator,
                    "rouletteTripletMultiplcator" => $casino->rouletteTripletMultiplcator,
                    "rouletteTripleSeventMultiplicator" => $casino->rouletteTripleSeventMultiplicator,
                    "rouletteMaxBet" => $casino->rouletteMaxBet,
                    "rouletteVIPSequenceMultiplicator" => $casino->rouletteVIPSequenceMultiplicator,
                    "rouletteVIPTripletMultiplcator" => $casino->rouletteVIPTripletMultiplcator,
                    "rouletteVIPTripleSeventMultiplicator" => $casino->rouletteVIPTripleSeventMultiplicator,
                    "rouletteMaxVIPBet" => $casino->rouletteMaxVIPBet,
                    "diceGoal" => $casino->diceGoal,
                    "diceWinMultiplicator" => $casino->diceWinMultiplicator,
                    "diceMaxBet" => $casino->diceMaxBet,
                    "diceVIPGoal" => $casino->diceVIPGoal,
                    "diceVIPWinMultiplicator" => $casino->diceVIPWinMultiplicator,
                    "diceVIPMaxBet" => $casino->diceVIPMaxBet,
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
                    "pokerMaxBet" => $casino->pokerMaxBet,
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
                    "pokerMaxVIPBet" => $casino->pokerMaxVIPBet,
                    "blackJackWinMultiplicator" => $casino->blackJackWinMultiplicator,
                    "blackJackMultiplicator" => $casino->blackJackMultiplicator,
                    "blackJackMaxBet" => $casino->blackJackMaxBet,
                    "blackJackVIPWinMultiplicator" => $casino->blackJackVIPWinMultiplicator,
                    "blackJackVIPMultiplicator" => $casino->blackJackVIPMultiplicator,
                    "blackJackVIPMaxBet" => $casino->blackJackVIPMaxBet,
                    "roulette2StraigthUpMultiplicator" => $casino->roulette2StraigthUpMultiplicator,
                    "roulette2SplitMultiplicator" => $casino->roulette2SplitMultiplicator,
                    "roulette2treetMultiplicator" => $casino->roulette2treetMultiplicator,
                    "roulette2CornerMultiplicator" => $casino->roulette2CornerMultiplicator,
                    "roulette2SixLineMultiplicator" => $casino->roulette2SixLineMultiplicator,
                    "roulette2ColumnMultiplicator" => $casino->roulette2ColumnMultiplicator,
                    "roulette2DozenMultiplicator" => $casino->roulette2DozenMultiplicator,
                    "roulette2OddEvenMultiplicator" => $casino->roulette2OddEvenMultiplicator,
                    "roulette2RedBlackMultiplicator" => $casino->roulette2RedBlackMultiplicator,
                    "roulette2MiddleMultiplicator" => $casino->roulette2MiddleMultiplicator,
                    "roulette2MaxBet" => $casino->roulette2MaxBet,
                    "roulette2VIPStraigthUpMultiplicator" => $casino->roulette2VIPStraigthUpMultiplicator,
                    "roulette2VIPSplitMultiplicator" => $casino->roulette2VIPSplitMultiplicator,
                    "roulette2VIPtreetMultiplicator" => $casino->roulette2VIPtreetMultiplicator,
                    "roulette2VIPCornerMultiplicator" => $casino->roulette2VIPCornerMultiplicator,
                    "roulette2VIPSixLineMultiplicator" => $casino->roulette2VIPSixLineMultiplicator,
                    "roulette2VIPColumnMultiplicator" => $casino->roulette2VIPColumnMultiplicator,
                    "roulette2VIPDozenMultiplicator" => $casino->roulette2VIPDozenMultiplicator,
                    "roulette2VIPOddEvenMultiplicator" => $casino->roulette2VIPOddEvenMultiplicator,
                    "roulette2VIPRedBlackMultiplicator" => $casino->roulette2VIPRedBlackMultiplicator,
                    "roulette2VIPMiddleMultiplicator" => $casino->roulette2VIPMiddleMultiplicator,
                    "roulette2VIPMaxBet" => $casino->roulette2VIPMaxBet,
                ]
            ])
        ];
    }
}
