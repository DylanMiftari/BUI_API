<?php

namespace App\Http\Resources;

use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CasinoTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "isVIP" => $this->isVIP,
            "createdAt" => $this->created_at,
            "expireAt" => $this->created_at->addDays(config("casino.ticket-lifetime-days")),
            "casino" => new CasinoResource($this->casino),
            $this->mergeWhen(With::has("max-bet"), [
                "maxBetRoulette" => $this->casino->getMaxBetForGame("roulette", $this->isVIP),
                "maxBetDice" => $this->casino->getMaxBetForGame("dice", $this->isVIP),
                "maxBetPoker" => $this->casino->getMaxBetForGame("poker", $this->isVIP),
                "maxBetBlackjack" => $this->casino->getMaxBetForGame("blackjack", $this->isVIP),
                "maxBetRoulette2" => $this->casino->getMaxBetForGame("roulette2", $this->isVIP),
            ])
        ];
    }
}
