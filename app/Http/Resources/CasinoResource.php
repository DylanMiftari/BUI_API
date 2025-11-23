<?php

namespace App\Http\Resources;

use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CasinoResource extends JsonResource
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
            "company" => new CompanyResource($this->company),
            $this->mergeWhen(With::has("casino-dashboard"), [
                "ticketPrice" => $this->ticketPrice,
                "activeTicketsCount" => $this->getActiveTicketsCount(),
                "maxTicketCount" => $this->casinoLevel->nbMaxTicket,
                "VIPTicketPrice" => $this->VIPTicketPrice,
                "activeVIPTicketsCount" => $this->getActiveVIPTicketsCount(),
                "maxVIPTicketCount" => $this->casinoLevel->nbMaxVIPTicket
            ])
        ];
    }
}
