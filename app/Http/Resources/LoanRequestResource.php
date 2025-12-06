<?php

namespace App\Http\Resources;

use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "status" => $this->status,
            "money" => $this->money,
            "weeklypayment" => $this->weeklypayment,
            "alreadyPayed" => $this->alreadyPayed,
            "rate" => $this->rate,
            "description" => $this->description,
            "user" => $this->when(With::has("user"), new UserResource($this->user))
        ];
    }
}
