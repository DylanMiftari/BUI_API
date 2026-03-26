<?php

namespace App\Http\Middleware\Mafia;

use App\Exceptions\Mafia\NotYourContractException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckContractOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mafiaContract = $request->route()->parameter("mafiaContract");
        if($mafiaContract->user->id != Auth::id()) {
            return throw new NotYourContractException();
        }
        return $next($request);
    }
}
