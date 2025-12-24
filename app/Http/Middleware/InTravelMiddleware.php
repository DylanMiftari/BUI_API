<?php

namespace App\Http\Middleware;

use App\Exceptions\InTravelException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InTravelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if($user->inTravel) {
            $endTravel = Carbon::createFromFormat("Y-m-d H:i:s", $user->endTravel);
            if($endTravel->isBefore(Carbon::now())) {
                $user->inTravel = false;
                $user->save();
                return $next($request);
            }
            throw new InTravelException();
        }
        return $next($request);
    }
}
