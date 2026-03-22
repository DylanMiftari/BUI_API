<?php

namespace App\Http\Middleware\Mafia;

use App\Exceptions\Company\NotCompanyOwnerException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMafiaOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mafia = $request->route()->parameter('mafia');

        if (!$mafia->relationLoaded('company')) {
            $mafia->load('company');
        }

        if ($mafia->company->userId != Auth::id()) {
            throw new NotCompanyOwnerException();
        }

        return $next($request);
    }
}
