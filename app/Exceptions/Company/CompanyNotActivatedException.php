<?php

namespace App\Exceptions\Company;

use Exception;
use Illuminate\Validation\UnauthorizedException;

class CompanyNotActivatedException extends UnauthorizedException
{
    public function __construct()
    {
        parent::__construct("You are not the owner of this company");
    }
}
