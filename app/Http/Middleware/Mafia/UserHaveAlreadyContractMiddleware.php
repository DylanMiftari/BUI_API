<?php

namespace App\Http\Middleware\Mafia;

use App\Exceptions\Mafia\UserHaveAlreadyContractException;
use App\Models\MafiaContract;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserHaveAlreadyContractMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mafia = $request->route()->parameter("mafia");
        if(MafiaContract::where("userId", Auth::id())
            ->where("mafiaId", $mafia->id)->exists()
        ) {
            return throw new UserHaveAlreadyContractException();
        }
        return $next($request);
    }
}
