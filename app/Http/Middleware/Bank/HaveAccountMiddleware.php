<?php

namespace App\Http\Middleware\Bank;

use App\Exceptions\Bank\AlreadyHaveBankAccountException;
use App\Exceptions\Bank\NotHaveAccountException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HaveAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bank = $request->route()->parameter('bank');
        if(Auth::user()->bankAccountForBank($bank) == null) {
            return throw new NotHaveAccountException();
        }
        return $next($request);
    }
}
