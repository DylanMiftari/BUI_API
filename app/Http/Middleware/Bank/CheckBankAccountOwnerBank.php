<?php

namespace App\Http\Middleware\Bank;

use App\Exceptions\Bank\BankAccountNotInThisBankException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBankAccountOwnerBank
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bank = $request->route()->parameter("bank");
        $bankAccount = $request->route()->parameter("bankAccount");
        if($bankAccount->bankId == $bank->id && $bank->company->userId == Auth::id()) {
            return $next($request);
        }
        return throw new BankAccountNotInThisBankException();
    }
}
