<?php

namespace App\Http\Actions\City;

use App\Helpers\Money;
use App\Models\City;
use App\Services\CityService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MakeTravelAction
{
    public function __construct(
        private CityService $cityService,
    )
    {
    }

    public function handle(City $destination) {
        Money::pay(config("city.travel_price"), "Travel to ".$destination->name);

        $user = Auth::user();
        $user->inTravel = true;
        $user->endTravel = Carbon::now()->addDays(
            $this->cityService->getTravelDuration($user->city, $destination)
        );
        $user->city_id = $destination->id;
        $user->save();
    }
}
