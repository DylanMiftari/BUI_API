<?php

namespace App\Http\Middleware\Bank;

use App\Exceptions\Bank\LoanRequestNotFromUserException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLoanRequestOwnerClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loanRequest = $request->route()->parameter("loanRequest");
        if($loanRequest->userId != Auth::id()) {
            return throw new LoanRequestNotFromUserException();
        }
        return $next($request);
    }
}
