<?php

namespace App\Rules\Casino;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class Roulette2CornerValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sortedValue = array_values(Arr::sort($value));

        if($sortedValue === [0, 1, 2, 3]) {
            return;
        }
        if(
            $sortedValue[0]+1 === $sortedValue[1] &&
            $sortedValue[2]+1 === $sortedValue[3] &&
            (
                $sortedValue[0]%3 === 1 && $sortedValue[2]%3 === 1 &&
                $sortedValue[1]%3 === 2 && $sortedValue[3]%3 === 2
            ) ||
            (
                $sortedValue[0]%3 === 2 && $sortedValue[2]%3 === 2 &&
                $sortedValue[1]%3 === 0 && $sortedValue[3]%3 === 0
            )
        ) {
            return;
        }

        $fail("Your corner is not a valid corner");
    }
}
