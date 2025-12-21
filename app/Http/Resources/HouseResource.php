<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "type" => $this->houseType->typeName,
            "maintenanceCost" => $this->houseType->maintenanceCost,
            "level" => $this->houseType->id
        ];
    }
}
