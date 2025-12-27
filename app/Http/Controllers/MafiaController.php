<?php

namespace App\Http\Controllers;

use App\Http\Actions\Mafia\MafiaGetTargetsAction;
use App\Http\Resources\MafiaResource;
use App\Models\Mafia;
use App\Services\MafiaService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MafiaController extends Controller
{

    //
    public function getMafiaForClient(Mafia $mafia)
    {
        return new MafiaResource($mafia);
    }

    public function getTargets(Mafia $mafia, MafiaGetTargetsAction $action)
    {
        $res = $action->handle($mafia, Auth::user());

        return $res;
    }
}
