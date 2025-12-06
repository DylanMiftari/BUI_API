<?php

namespace App\Http\Resources;

use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankAccountResource extends JsonResource
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
            "accountMaintenanceCost" => $this->accountMaintenanceCost,
            "transferCost" => $this->transferCost,
            "money" => $this->money,
            "maxMoney" => $this->maxMoney,
            "resource" => $this->resourceQuantity(),
            "maxResource" => $this->maxResource,
            "isEnable" => $this->isEnable,
            "user" => $this->when(With::has("user"), new UserResource($this->user))
        ];
    }
}
