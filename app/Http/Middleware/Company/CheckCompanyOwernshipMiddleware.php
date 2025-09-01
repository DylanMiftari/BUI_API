<?php

namespace App\Http\Middleware\Company;

use App\Exceptions\Company\NotCompanyOwnerException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyOwernshipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = $request->route()->parameter('company');
        if($company->userId != Auth::id()) {
            throw new NotCompanyOwnerException();
        }

        return $next($request);
    }
}
