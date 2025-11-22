<?php

namespace App\Rules\Casino;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class Roulette2StreetValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sortedValue = array_values(Arr::sort($value));

        if($sortedValue[0] === 0) {
            $fail("Your street is not a valid street");
        }
        if($sortedValue[0]+1 === $sortedValue[1] && $sortedValue[1]+1 === $sortedValue[2] &&
            $sortedValue[0]%3 === 1) {
            return;
        }

        $fail("Your street is not a valid street");
    }
}
