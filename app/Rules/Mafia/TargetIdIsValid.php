<?php

namespace App\Rules\Mafia;

use App\Enums\MafiaTargetType;
use App\Models\Mafia;
use App\Services\MafiaService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class TargetIdIsValid implements ValidationRule
{
    private MafiaService $mafiaService;
    public function __construct()
    {
        $this->mafiaService = app(MafiaService::class);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mafia = request()->route()->parameter("mafia");
        $seed = $this->mafiaService->generateSeed($mafia, Auth::user());

        $targetType = MafiaTargetType::from(request()->input("targetType"));
        $list = collect();
        switch ($targetType) {
            case MafiaTargetType::USER:
                $list = $this->mafiaService->getTargetPlayer($mafia, $seed);
                break;
            case MafiaTargetType::COMPANY:
                $list = $this->mafiaService->getTargetCompany($mafia, $seed);
                break;
            case MafiaTargetType::BANK_ACCOUNT:
                $list = $this->mafiaService->getTargetBankAccount($mafia, $seed);
                break;
            case MafiaTargetType::HOME:
                $list = $this->mafiaService->getTargetHouse($mafia, $seed);
                break;
            case MafiaTargetType::CYBERATTACK:
                $list = $this->mafiaService->getTargetCyberAttack($mafia, $seed);
                break;
            case MafiaTargetType::USER_DRONE:
                $list = $this->mafiaService->getTargetAiDronePlayer($mafia, $seed);
                break;
            case MafiaTargetType::HOME_DRONE:
                $list = $this->mafiaService->getTargetAiDroneHouse($mafia, $seed);
                break;
            case MafiaTargetType::SHOPLIFTING:
                $list = $this->mafiaService->getTargetShoplifting($mafia, $seed);
                break;
            case MafiaTargetType::PHISHING:
                $list = $this->mafiaService->getTargetPhishing($mafia, $seed);
        }

        if($list->where("id", $value)->count() === 0) {
            $fail("This target is not available for you in this mafia");
        }
    }
}
