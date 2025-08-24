<?php

namespace App\Http\Controllers;

use App\Helpers\Paginate;
use App\Helpers\With;
use App\Http\Requests\City\GetCityCompaniesRequest;
use App\Http\Resources\CityResource;
use App\Http\Resources\CompanyResource;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function __construct(protected CityService $cityService) {
    }

    public function myCity() {
        return new CityResource(Auth::user()->city);
    }

    public function myCityCompanies(GetCityCompaniesRequest $request) {
        With::add("ownerName");
        $companies = Paginate::paginateFromCollection(
            $this->cityService->getCompaniesOfCity(
                Auth::user()->city,
                $request->input("name"),
                $request->input("type"),
                $request->input("level")
            ),
            $request->input("page", 1),
            $request->input("per_page", 20)
        );

        return CompanyResource::collection($companies);
    }
}
