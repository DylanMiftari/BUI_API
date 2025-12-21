<?php

namespace App\Http\Resources;

use App\Helpers\With;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CityResource extends JsonResource
{
    private CityService $cityService;
    public function __construct(
        $resource
    )
    {
        $this->cityService = app(CityService::class);
        parent::__construct($resource);
    }

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
            "maxLevelOfCorp" => $this->maxLevelOfCorp,
            "weeklyTaxes" => $this->weeklyTaxes,
            "weeklyCompanyTaxes" => $this->weeklyCompanyTaxes,
            "rank" => $this->rank,
            $this->mergeWhen(With::has("travel"), [
                "travelDuration" => $this->cityService->getTravelDuration(Auth::user()->city, $this->resource),
                "travelPrice" => config("city.travel_price"),
                "companyCount" => $this->companies()->count()
            ])
        ];
    }
}
