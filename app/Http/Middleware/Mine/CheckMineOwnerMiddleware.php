<?php

namespace App\Http\Middleware\Mine;

use App\Exceptions\NotYourMineException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMineOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mine = $request->route()->parameter("mine");
        if($mine->userId != Auth::id()) {
            throw new NotYourMineException();
        }

        return $next($request);
    }
}
