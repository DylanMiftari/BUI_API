<?php

namespace App\Exceptions\Mafia;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class UserHaveAlreadyContractException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("You can only have 1 active contract in this mafia");
    }
}
