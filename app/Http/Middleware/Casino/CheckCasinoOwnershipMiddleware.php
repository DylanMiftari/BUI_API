<?php

namespace App\Http\Middleware\Casino;

use App\Exceptions\Company\NotCompanyOwnerException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCasinoOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $casino = $request->route()->parameter('casino');

        // Ensure casino is loaded with company to check ownership
        if (!$casino->relationLoaded('company')) {
            $casino->load('company');
        }

        if ($casino->company->userId != Auth::id()) {
            throw new NotCompanyOwnerException();
        }

        return $next($request);
    }
}
