<?php

namespace App\Http\Middleware\Bank;

use App\Exceptions\Bank\AlreadyHaveBankAccountException;
use App\Models\Bank;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NotHaveBankAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bank = $request->route()->parameter('bank');
        if(Auth::user()->bankAccountForBank($bank) != null) {
            return throw new AlreadyHaveBankAccountException();
        }
        return $next($request);
    }
}
