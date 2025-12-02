<?php

namespace App\Exceptions\Bank;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class NotHaveAccountException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("You don't have account in this bank");
    }
}
