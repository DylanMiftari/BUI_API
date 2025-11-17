<?php

namespace App\Http\Middleware\Mine;

use App\Exceptions\Mine\MineIsInProcessingException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MineNotProcessingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mine = $request->route()->parameter("mine");
        if($mine->currentTargetResourceId !== null) {
            throw new MineIsInProcessingException();
        }
        return $next($request);
    }
}
