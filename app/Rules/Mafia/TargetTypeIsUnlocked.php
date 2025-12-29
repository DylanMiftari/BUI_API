<?php

namespace App\Rules\Mafia;

use App\Enums\MafiaTargetType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TargetTypeIsUnlocked implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mafia = request()->route()->parameter("mafia");
        $targetType = MafiaTargetType::from($value);

        if($targetType == MafiaTargetType::CYBERATTACK &&
        $mafia->level < config("mafia.cyberattack.minLevelOfMafia")) {
            $fail("This mafia can't do cyberattack");
        } else if($targetType == MafiaTargetType::USER_DRONE &&
            $mafia->level < config("mafia.aiDrone.minLevelOfMafia")) {
            $fail("This mafia can't do ai player drone attack");
        } else if($targetType == MafiaTargetType::HOME_DRONE &&
            $mafia->level < config("mafia.aiDrone.minLevelOfMafia")) {
            $fail("This mafia can't do ai home drone attack");
        } else if($targetType == MafiaTargetType::SHOPLIFTING &&
            $mafia->level < config("mafia.shoplifting.minLevelOfMafia")) {
            $fail("This mafia can't do shoplifting");
        } else if($targetType == MafiaTargetType::PHISHING &&
            $mafia->level < config("mafia.phishing.minLevelOfMafia")) {
            $fail("This mafia can't do phishing");
        }
    }
}
