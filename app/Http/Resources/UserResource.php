<?php

namespace App\Http\Resources;

use App\Helpers\Money;
use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "pseudo" => $this->pseudo,
            "userMoney" => $this->when(With::securedHas("userMoney", $this->resource), Money::getAllMoney()),
            "companies" => $this->when(With::has("company"), CompanyResource::collection($this->companies)),
            "mines" => $this->when(With::has("mine"), MineResource::collection($this->mines)),
            $this->mergeWhen(With::securedHas("dashboard", $this->resource), [
                "companiesCount" => $this->companies->count(),
                "minesCount" => $this->mines->count(),
                "resourceSum" => $this->userResources->sum("quantity"),
                "cityName" => $this->city->name,
                "casinoTicketsCount" => $this->casinoTickets()->count(),
                "activeAccount" => $this->bankAccounts()->count()
            ])
        ];
    }
}
