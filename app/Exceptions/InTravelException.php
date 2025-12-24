<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class InTravelException extends AuthorizationException
{
    public function __construct() {
        parent::__construct("You can't do this action during a travel");
    }

    public function render(Request $request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'error'   => 'InTravelError'
        ], 409);
    }
}
