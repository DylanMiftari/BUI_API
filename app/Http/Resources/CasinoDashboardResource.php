<?php

namespace App\Http\Resources;

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
            "levels" => $levels
        ];
    }
}
