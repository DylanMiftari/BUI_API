<?php

namespace App\Http\Middleware\Casino;

use App\Exceptions\Casino\UserHasNotTicketException;
use App\Models\Casino;
use App\Services\CasinoService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\ChecksumAlgoIsNotSupported;
use Symfony\Component\HttpFoundation\Response;

class CheckTicketMiddleware
{
    public function __construct(private CasinoService $casinoService)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $casino = $request->route()->parameter("casino");
        if(!$this->casinoService->userHasTicket(Auth::user(), $casino)) {
            return throw new UserHasNotTicketException();
        }
        return $next($request);
    }
}
