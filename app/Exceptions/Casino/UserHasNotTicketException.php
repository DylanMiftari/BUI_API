<?php

namespace App\Exceptions\Casino;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class UserHasNotTicketException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("You must have a valid ticket to play at the casino");
    }
}
