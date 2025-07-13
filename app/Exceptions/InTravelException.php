<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class InTravelException extends AuthorizationException
{
    public function __construct() {
        parent::__construct("You can't do this action during a travel");
    }
}
