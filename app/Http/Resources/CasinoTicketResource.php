<?php

namespace App\Http\Resources;

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
            "casino" => new CasinoResource($this->casino)
        ];
    }
}
