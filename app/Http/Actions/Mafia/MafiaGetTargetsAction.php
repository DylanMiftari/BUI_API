<?php

namespace App\Http\Actions\Mafia;

use App\Helpers\With;
use App\Http\Resources\BankAccountResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\HouseResource;
use App\Http\Resources\MinimalBankAccountResource;
use App\Http\Resources\UserResource;
use App\Models\Mafia;
use App\Models\User;
use App\Services\MafiaService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MafiaGetTargetsAction
{
    public function __construct(
        private MafiaService $mafiaService
    )
    {
    }

    public function handle(Mafia $mafia, User $user) {
        $day = Carbon::now()->format('Ymd');
        $seed = strval($mafia->id).strval($user->id).$day;
        With::add("mafia");

        $res = [
            "player" => UserResource::collection($this->mafiaService->getTargetPlayer($mafia, $seed)),
            "company" => CompanyResource::collection($this->mafiaService->getTargetCompany($mafia, $seed)),
            "bankAccount" => MinimalBankAccountResource::collection($this->mafiaService->getTargetBankAccount($mafia, $seed)),
            "house" => HomeResource::collection($this->mafiaService->getTargetHouse($mafia, $seed)),
        ];

        if($mafia->level >= config("mafia.cyberattack.minLevelOfMafia")) {
            $res["cyberattack"] = CompanyResource::collection($this->mafiaService->getTargetCyberAttack($mafia, $seed));
        }
        if($mafia->level >= config("mafia.aiDrone.minLevelOfMafia")) {
            $res["aiDronePlayer"] = UserResource::collection($this->mafiaService->getTargetAiDronePlayer($mafia, $seed));
            $res["aiDroneHouse"] = HomeResource::collection($this->mafiaService->getTargetAiDroneHouse($mafia, $seed));
        }
        if($mafia->level >= config("mafia.shoplifting.minLevelOfMafia")) {
            $res["shoplifting"] = CompanyResource::collection($this->mafiaService->getTargetShoplifting($mafia, $seed));
        }
        if($mafia->level >= config("mafia.phishing.minLevelOfMafia")) {
            $res["phishing"] = MinimalBankAccountResource::collection($this->mafiaService->getTargetPhishing($mafia, $seed));
        }

        return $res;
    }
}
