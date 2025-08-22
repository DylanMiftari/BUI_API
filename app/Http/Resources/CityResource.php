<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            "name" => $this->name,
            "country" => $this->country,
            "max_level_of_corp" => $this->maxLevelOfCorp,
            "weekly_taxes" => $this->weeklyTaxes,
            "weekly_company_taxes" => $this->weeklyCompanyTaxes,
            "rank" => $this->rank
        ];
    }
}
