<?php

namespace App\Http\Actions\Company;

use App\Helpers\Money;
use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Support\Facades\DB;

class CreateCompanyAction {

    public function __construct(protected CompanyService $companyService) {}

    public function handle(User $user, string $companyName, string $companyType) {
        Money::pay(config("company.company_creation_price"), "Create your new company $companyName of type $companyType");
        return $this->companyService->createCompany($user, $companyName, $companyType);
    }

}
