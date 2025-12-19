<?php

namespace App\Exceptions\Bank;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class BankAccountNotInThisBankException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("This bank account is not in your bank");
    }
}
