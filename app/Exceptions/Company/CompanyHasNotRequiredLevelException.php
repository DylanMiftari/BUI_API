<?php

namespace App\Exceptions\Company;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CompanyHasNotRequiredLevelException extends UnprocessableEntityHttpException
{
    public function __construct(int $requiredLevel) {
        parent::__construct("The company has not the required level. The required level is {$requiredLevel}");
    }
}
