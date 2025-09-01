<?php

namespace App\Exceptions\Company;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class NotCompanyOwnerException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("You are not the owner of this company");
    }
}
