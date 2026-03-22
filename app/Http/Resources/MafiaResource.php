<?php

namespace App\Http\Resources;

use App\Enums\MafiaContractStatus;
use App\Helpers\With;
use App\Models\MafiaLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MafiaResource extends JsonResource
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
            "name" => $this->company->name,
            "level" => $this->level,
            $this->mergeWhen(With::securedHas("mafiaOwner", $this->company->user), [
                "contracts" => MafiaContractResource::collection($this->contracts()->where("robState", "!=", MafiaContractStatus::FINISHED)->get()),
                "moneyInSafe" => $this->company->moneyInSafe,
                "companyId" => $this->company->id
            ]),
            $this->mergeWhen(With::has("levels"), [
                "levels" => MafiaLevel::all()
            ])
        ];
    }
}
