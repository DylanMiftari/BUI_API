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
            "user" => $this->when(With::has("user"), new UserResource($this->user)),
            "company" => new CompanyResource($this->bank->company),
            "bankId" => $this->bankId,
            $this->mergeWhen(With::has("details"), [
                "userHand" => [
                    "money" => $this->user->playerMoney,
                    "resource" => $this->user->resourceQuantity()
                ],
                "transactions" => BankAccountTransactionResource::collection($this->transactions()->orderByDesc("created_at")->limit(30)->get()),
            ]),
            "resources" => $this->when(With::has("resources"), $this->resource->resources())
        ];
    }
}
