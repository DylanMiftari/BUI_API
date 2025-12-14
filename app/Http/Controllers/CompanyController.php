<?php

namespace App\Http\Controllers;

use App\Helpers\With;
use App\Http\Actions\Company\CreateCompanyAction;
use App\Http\Actions\Company\UpgradeCompanyAction;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Resources\BankResource;
use App\Http\Resources\CasinoResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function getCompaniesOfPlayer() {
        With::add("money");
        return CompanyResource::collection(Auth::user()->companies);
    }

    public function create(CreateCompanyRequest $request, CreateCompanyAction $action) {
        $this->authorize("create", Company::class);

        $company = $action->handle(Auth::user(), $request->input("name"), $request->input("type"));

        return new CompanyResource($company);
    }

    public function upgrade(Company $company, UpgradeCompanyAction $action) {
        $this->authorize("upgrade", $company);

        $action->handle($company);

        return response()->json([
            "result" => true,
        ]);
    }

    public function getSubCompany(Company $company)
    {
        switch($company->companyType) {
            case "casino":
                return new CasinoResource($company->casino);
            case "bank":
                return new BankResource($company->bank);
        }
    }
}
