<?php

namespace App\Exceptions\Bank;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class LoanRequestNotFromUserException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("This loan request is not your loan request");
    }
}
