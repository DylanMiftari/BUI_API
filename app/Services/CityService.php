<?php

namespace App\Services;

use App\Models\City;

class CityService {

    public function getCompaniesOfCity(City $city, string|null $name = null, string|null $type = null, string|null $level = null) {
        $query = $city->companies()->where("activated", true);
        if($name) {
            $query->whereLike("name", "%$name%");
        }
        if($type) {
            $query->where("companyType", $type);
        }
        if($level) {
            $query->where("companyLevel", $level);
        }

        return $query->get();
    }

    public function getPossibleTravels(City $city) {
        $cities = City::whereNot("id", $city->id)->get();
        return $cities;
    }

    public function getTravelDuration(City $fromCity, City $destCity): int {
        return config("city.travel_base_duration_days") +
            abs($destCity->rank - $fromCity->rank) * config("city.travel_duration_by_rank_days");
    }

}
