<?php

namespace App\Policies;

use App\Helpers\Money;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    public function create(User $user) {
        Money::check(config("company.company_creation_price"));
        if($user->companies()->count() + 1 > config("company.max_companies_per_user")) {
            return Response::deny("You can't have more than ".config("company.max_companies_per_user")." companies");
        }
        return Response::allow();
    }
}
