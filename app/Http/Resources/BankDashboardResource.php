<?php

namespace App\Http\Resources;

use App\Models\BankLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankDashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "bank" => [
                "id" => $this->id,
                "name" => $this->company->name,
                "level" => $this->level,
                "moneyInSafe" => $this->company->moneyInSafe,
                "nbAccount" => $this->bankAccounts()->count(),
                "maxNbAccount" => $this->bankLevel->maxNbAccount,
                "nbLoans" => $this->loanRequests()->count(),
                "companyId" => $this->company->id,
            ],
            "bankLevel" => BankLevel::all(),
            "config" => [
                "accountMaintenanceCost" => $this->accountMaintenanceCost,
                "transferCost" => $this->transferCost,
                "maxAccountMoney" => $this->maxAccountMoney,
                "maxAccountResource" => $this->maxAccountResource
            ]
        ];
    }
}
