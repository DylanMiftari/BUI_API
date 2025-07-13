<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class NotYourMineException extends AuthorizationException
{
    public function __construct() {
        parent::__construct("This is not your mine");
    }
}
