<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlackjackPartyResource extends JsonResource
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
            "userHand" => $this->userHand,
            "bankHand" => request()->attributes->get('show_bank_hand') ?
            $this->bankHand : [$this->bankHand[0]],
            "bet" => $this->bet
        ];
    }
}
