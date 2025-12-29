<?php

namespace App\Http\Controllers;

use App\Enums\MafiaTargetType;
use App\Http\Actions\Mafia\CreateMafiaContractAction;
use App\Http\Actions\Mafia\MafiaGetTargetsAction;
use App\Http\Requests\Mafia\CreateContractRequest;
use App\Http\Resources\MafiaContractResource;
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

    public function createContract(CreateContractRequest $request, Mafia $mafia, CreateMafiaContractAction $action)
    {
        $contract = $action->handle(
            $mafia,
            Auth::user(),
            MafiaTargetType::from($request->input('targetType')),
            $request->input('targetId')
        );

        return new MafiaContractResource($contract);
    }
}
