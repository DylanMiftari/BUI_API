<?php

namespace App\Http\Resources;

use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MineResource extends JsonResource
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
            "startedAt" => $this->startedAt,
            "resource" => $this->when(With::has("resource"), new ResourceResource($this->resource->resource)),
            "mineLevel" => $this->when(With::has("level"), $this->mineLevel),
            "hourlyIncome" => $this->when(With::has("hourlyIncome"), $this->getHourlyIncome())
        ];
    }
}
