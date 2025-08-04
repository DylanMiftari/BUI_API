<?php

namespace App\Exceptions\Mine;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class MineIsNotInProcessingException extends AuthorizationException
{
    public function __construct() {
        parent::__construct("You can't do this action while the mine is not in processing");
    }
}
