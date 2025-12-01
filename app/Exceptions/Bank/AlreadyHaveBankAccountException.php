<?php

namespace App\Exceptions\Bank;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class AlreadyHaveBankAccountException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("You already have a bank account in this bank");
    }
}
