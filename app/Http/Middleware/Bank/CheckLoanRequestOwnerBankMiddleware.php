<?php

namespace App\Http\Middleware\Bank;

use App\Exceptions\Bank\LoanRequestNotInThisBankException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoanRequestOwnerBankMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bank = $request->route()->parameter("bank");
        $loanRequest = $request->route()->parameter("loanRequest");
        if($loanRequest->bankId !== $bank->id) {
            return throw new LoanRequestNotInThisBankException();
        }
        return $next($request);
    }
}
