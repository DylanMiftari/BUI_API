<?php

namespace App\Http\Actions\Company;

use App\Helpers\Money;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class UpgradeCompanyAction
{

    public function handle($company): Company {
        $user = Auth::user();

        Money::pay(config("company.company_upgrade_cost")[$company->companyLevel+1],
            "Upgrade your ".$company->name." at the level ".($company->companyLevel+1));

        $company->companyLevel++;
        $company->save();

        switch ($company->companyType) {
            case "bank":
                $company->bank->level++;
                $company->bank->save();
                break;
            case "casino":
                $company->casino->level++;
                $company->casino->save();
                break;
            case "mafia":
                $company->mafia->level++;
                $company->mafia->save();
                break;
            case "estate":
                $company->estate->level++;
                $company->estate->save();
                break;
            case "factory":
                $company->factory->level++;
                $company->factory->save();
                break;
            case "security":
                $company->security->level++;
                $company->security->save();
                break;
        }

        return $company;
    }

}
