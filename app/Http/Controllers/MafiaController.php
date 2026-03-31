<?php

namespace App\Http\Controllers;

use App\Enums\MafiaContractStatus;
use App\Enums\MafiaTargetType;
use App\Helpers\With;
use App\Http\Actions\Mafia\AcceptMafiaContractAction;
use App\Http\Actions\Mafia\CreateMafiaContractAction;
use App\Http\Actions\Mafia\GetMafiaContractFromClient;
use App\Http\Actions\Mafia\MafiaClaimContract;
use App\Http\Actions\Mafia\MafiaGetTargetsAction;
use App\Http\Actions\Mafia\MafiaRobAction;
use App\Http\Actions\Mafia\UpdateMafiaContractAction;
use App\Http\Requests\Mafia\CreateContractRequest;
use App\Http\Requests\Mafia\UpdateContractPriceRequest;
use App\Http\Resources\MafiaContractResource;
use App\Http\Resources\MafiaResource;
use App\Models\Mafia;
use App\Models\MafiaContract;
use App\Services\MafiaService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MafiaController extends Controller
{
    use AuthorizesRequests;

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

    public function getContractForClient(Mafia $mafia, GetMafiaContractFromClient $action)
    {
        $contract = $action->handle($mafia, Auth::user());
        if ($contract) {
            return new MafiaContractResource($contract);
        }
        return null;
    }

    public function getPlayerContracts()
    {
        return MafiaContractResource::collection(Auth::user()->mafiaContracts()->where("robState", "!=",
        MafiaContractStatus::FINISHED)->get());
    }

    public function getMafiaForOwner(Mafia $mafia)
    {
        With::add("mafiaOwner");
        return new MafiaResource($mafia);
    }

    public function updatePriceForOwner(
        UpdateContractPriceRequest $request, Mafia $mafia, MafiaContract $mafiaContract,
        UpdateMafiaContractAction $action
    )
    {
        $this->authorize("updatePriceForOwner", $mafiaContract);
        $action->handle($mafiaContract, $request->input("price"), MafiaContractStatus::WAIT_ON_CLIENT);
        return response()->noContent();
    }

    public function updatePriceForClient(
        UpdateContractPriceRequest $request, Mafia $mafia, MafiaContract $mafiaContract,
        UpdateMafiaContractAction $action
    )
    {
        $this->authorize("updatePriceForClient", $mafiaContract);
        $action->handle($mafiaContract, $request->input("price"), MafiaContractStatus::WAIT_ON_MAFIA);
        return response()->noContent();
    }

    public function rob(Mafia $mafia, MafiaContract $mafiaContract, MafiaRobAction $action)
    {
        $this->authorize("rob", $mafiaContract);
        $res = $action->handle($mafiaContract);

        return $res;
    }

    public function acceptContract(Mafia $mafia, MafiaContract $mafiaContract, AcceptMafiaContractAction $action)
    {
        $this->authorize("acceptContract", $mafiaContract);
        $action->handle($mafiaContract);

        return response()->noContent();
    }

    public function claimContract(Mafia $mafia, MafiaContract $mafiaContract, MafiaClaimContract $action)
    {
        $this->authorize("claimContract", $mafiaContract);
        $action->handle($mafiaContract);

        return response()->noContent();
    }
}
