<?php

namespace App\Exceptions\Mafia;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class MafiaRobCooldownException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("Your target has already been stolen too recently");
    }
}
