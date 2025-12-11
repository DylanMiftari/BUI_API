<?php

namespace App\Http\Resources;

use App\Helpers\With;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            "type" => $this->companyType,
            "activated" => $this->activated,
            "level" => $this->companyLevel,
            "moneyInSafe" => $this->when(With::securedHas("money", $this->user), $this->moneyInSafe),
            "owner_name" => $this->when(With::has("ownerName"), $this->user->pseudo),
            "sub_company_id" => $this->getSubCompanyId()
        ];
    }
}
