<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankAccountTransactionResource extends JsonResource
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
            "money" => $this->money,
            "description" => $this->description,
            "transferCost" => $this->transfert_cost,
            "isCredit" => $this->isCredit,
            "createdAt" => $this->created_at
        ];
    }
}
