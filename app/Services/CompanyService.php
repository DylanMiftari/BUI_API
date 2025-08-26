<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\Casino;
use App\Models\Company;
use App\Models\EstateAgency;
use App\Models\Factory;
use App\Models\Mafia;
use App\Models\SecurityCompany;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CompanyService {

    public function createCompany(User $user, string $companyName, string $companyType): Company {
        $company = DB::transaction(function() use ($companyName, $companyType, $user) {
            $company = new Company([
                "name" => $companyName,
                "companyType" => $companyType,
                "userId" => $user->id
            ]);
            $company->save();

            switch($companyType) {
                case "bank":
                    $bank = new Bank(["idCompany" => $company->id]);
                    $bank->save();
                    break;
                case "casino":
                    $casino = new Casino(["companyId" => $company->id]);
                    $casino->save();
                    break;
                case "mafia":
                    $mafia = new Mafia(["companyId" => $company->id]);
                    $mafia->save();
                    break;
                case "estate":
                    $estate = new EstateAgency(["companyId" => $company->id]);
                    $estate->save();
                    break;
                case "factory":
                    $factory = new Factory(["companyId" => $company->id]);
                    $factory->save();
                    break;
                case "security":
                    $security = new SecurityCompany(["companyId" => $company->id]);
                    $security->save();
                    break;
            }

            return Company::find($company->id);
        });

        return $company;
    }

}
