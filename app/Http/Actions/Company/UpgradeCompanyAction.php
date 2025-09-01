<?php

namespace App\Http\Actions\Company;

use App\Helpers\Money;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class UpgradeCompanyAction
{

    public function handle($company): Company {
        $user = Auth::user();

        Money::pay(config("company.company_upgrade_cost")[$company->companyLevel+1]);

        $company->companyLevel++;
        $company->save();

        return $company;
    }

}
