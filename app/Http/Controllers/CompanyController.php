<?php

namespace App\Http\Controllers;

use App\Helpers\With;
use App\Http\Actions\Company\CreateCompanyAction;
use App\Http\Requests\Company\CreateCompanyRequest;
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
}
