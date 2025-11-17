<?php

namespace App\Http\Middleware\Company;

use App\Exceptions\Company\CompanyHasNotRequiredLevelException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyLevelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $requiredLevel): Response
    {
        if($requiredLevel > $this->getCompanyLevel($request)) {
            return throw new CompanyHasNotRequiredLevelException($requiredLevel);
        }
        return $next($request);
    }

    private function getCompanyLevel(Request $request): int {
        $company = $request->route()->parameter('company');
        if($company === null) {
            $company = $request->route()->parameter('casino')->company;
        }

        return $company->companyLevel;
    }
}
