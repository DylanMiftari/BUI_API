<?php

namespace App\Http\Middleware\Casino;

use App\Exceptions\Company\CompanyNotActivatedException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CasinoIsActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $casino = $request->route()->parameter('casino');
        if(!$casino->company->activated) {
            return throw new CompanyNotActivatedException();
        }
        return $next($request);
    }
}
