<?php

namespace App\Exceptions\Bank;

use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class LoanRequestNotInThisBankException extends BadRequestException
{
    public function __construct()
    {
        parent::__construct("This loan request is not in this bank");
    }
}
