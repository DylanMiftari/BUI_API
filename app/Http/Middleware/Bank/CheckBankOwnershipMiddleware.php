<?php

namespace App\Http\Middleware\Bank;

use App\Exceptions\Company\NotCompanyOwnerException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBankOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bank = $request->route()->parameter('bank');

        if ($bank->company->userId != Auth::id()) {
            throw new NotCompanyOwnerException();
        }
        return $next($request);
    }
}
