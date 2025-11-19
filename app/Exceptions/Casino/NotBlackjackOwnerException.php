<?php

namespace App\Exceptions\Casino;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class NotBlackjackOwnerException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct("This blackjack party is not your party or this party isn't in this casino");
    }
}
