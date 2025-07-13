<?php

namespace App\Exceptions\mine;

use Illuminate\Auth\Access\AuthorizationException;

class MineIsInProcessingException extends AuthorizationException
{
    public function __construct() {
        parent::__construct("You can't do this action while the mine is in processing");
    }
}
