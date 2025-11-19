<?php

namespace App\Http\Middleware\Casino;

use App\Exceptions\Casino\NotBlackjackOwnerException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBlackjackPartyOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $blackJackParty = $request->route()->parameter('blackjack_party');
        $casino = $request->route()->parameter('casino');
        if($blackJackParty->casinoId !== $casino->id || $blackJackParty->userId != Auth::id()) {
            return throw new NotBlackjackOwnerException();
        }
        return $next($request);
    }
}
