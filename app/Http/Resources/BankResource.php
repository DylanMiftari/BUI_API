<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
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
            "level" => $this->level,
            "accountMaintenanceCost" => $this->accountMaintenanceCost,
            "transferCost" => $this->transferCost,
            "maxAccountMoney" => $this->maxAccountMoney,
            "maxAccountResource" => $this->maxAccountResource,
            "company" => new CompanyResource($this->company),
            "maxNbAccount" => $this->bankLevel->maxNbAccount,
            "nbAccount" => $this->bankAccounts()->count()
        ];
    }
}
