<?php

namespace App\Exceptions\Mafia;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class NotYourContractException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("This is not your contract.");
    }
}
